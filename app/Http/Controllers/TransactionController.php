<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Support\Carbon;
use App\Models\Transaction;
use App\Models\Item;
use App\Models\Service;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['customer', 'user']);

        if ($request->filled('invoice_no')) {
            $query->where('invoice_no', 'like', "%{$request->invoice_no}%");
        }
        if ($request->filled('customer_name')) {
            $query->whereHas('customer', fn($q) => $q->where('name','like',"%{$request->customer_name}%"));
        }
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $transactions = $query->latest()
                              ->simplePaginate(10)
                              ->appends($request->only(['invoice_no','customer_name','date_from','date_to']));

        return view('transactions.index', compact('transactions'));
    }

    public function exportXlsx(Request $request)
    {
        // Prepare the same query as index
        $query = Transaction::with(['customer', 'user']);
        
        if ($request->filled('invoice_no')) {
            $query->where('invoice_no', 'like', "%{$request->invoice_no}%");
        }
        
        if ($request->filled('customer_name')) {
            $query->whereHas('customer', fn($q) => $q->where('name','like',"%{$request->customer_name}%"));
        }
        
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }
    
        $fileName = 'transactions_' . now()->format('Ymd_His') . '.xlsx';
    
        return Response::streamDownload(function() use ($query) {
            $writer = WriterEntityFactory::createXLSXWriter();
            $writer->openToFile('php://output');
    
            // Header
            $writer->addRow(WriterEntityFactory::createRowFromArray([
                'Invoice No', 'Tanggal', 'Customer', 'Staff',
                'Total', 'Discount', 'Grand Total', 'Paid', 'Change', 'Payment Method'
            ]));
    
            // Data
            $query->chunk(500, function($transactions) use ($writer) {
                foreach ($transactions as $tx) {
                    // Cek apakah user memiliki role 'staff'
                    $staffName = optional($tx->user)->role === 'staff' ? optional($tx->user)->name : '-';
    
                    $writer->addRow(WriterEntityFactory::createRowFromArray([
                        $tx->invoice_no,
                        // Format the created_at date with Carbon
                        \Carbon\Carbon::parse($tx->created_at)->format('Y-m-d H:i'),
                        // Use optional() to prevent errors on null relationships
                        optional($tx->customer)->name ?? '-',
                        $staffName,  // Menampilkan nama user dengan role 'staff' atau '-'
                        $tx->total,
                        $tx->discount,
                        $tx->grand_total,
                        $tx->paid,
                        $tx->change,
                        $tx->payment_method,
                    ]));
                }
            });
    
            $writer->close();
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }
    

    

    public function create()
    {
        $invoiceNo = $this->generateInvoiceNo();
        $customers = Customer::all();
        $items     = Item::where('stock','>',0)->get();
        $services  = Service::where('status','pending')->get();
        return view('transactions.create', compact('customers','items','services', 'invoiceNo'));
    }

    protected function generateInvoiceNo(): string
    {
        $datePart = Carbon::now()->format('Ymd');

        // Hitung sudah berapa invoice hari ini
        $countToday = DB::table('transactions')
            ->whereDate('created_at', Carbon::today())
            ->count();

        // Urutan berikutnya
        $next = $countToday + 1;

        // 4-digit zero pad
        $seq = str_pad((string)$next, 4, '0', STR_PAD_LEFT);

        return 'INV' . $datePart . $seq;
    }

    public function store(StoreTransactionRequest $request)
    {
        $data = $request->validated();
    
        // Generate invoice_no otomatis
        $data['invoice_no'] = $this->generateInvoiceNo();
    
        DB::transaction(function() use ($data) {
            $total   = collect($data['lines'])->sum(fn($line) => $line['quantity'] * $line['price']);
            $discount= $data['discount'] ?? 0;
            $grand   = $total - $discount;
    
            $tx = Transaction::create([
                'invoice_no'     => $data['invoice_no'],
                'customer_id'    => $data['customer_id'] ?: null,
                'staff_id'       => Auth::id(),
                'total'          => $total,
                'discount'       => $discount,
                'grand_total'    => $grand,
                'paid'           => $data['paid'],
                'change'         => $data['paid'] - $grand,
                'payment_method' => $data['payment_method'],
                'status'         => 'paid',
            ]);
    
            foreach ($data['lines'] as $line) {
                $tx->transactionItems()->create([
                    'itemable_type' => $line['type'] === 'service' ? Service::class : Item::class,
                    'itemable_id'   => $line['id'],
                    'quantity'      => $line['quantity'],
                    'price'         => $line['price'],
                    'subtotal'      => $line['quantity'] * $line['price'],
                ]);
    
                if ($line['type'] === 'item') {
                    $item = Item::find($line['id']);
                    if ($item) {
                        $item->decrement('stock', $line['quantity']);
                    } else {
                        throw new \Exception("Item with ID {$line['id']} not found.");
                    }
                }
    
                if ($line['type'] === 'service') {
                    $service = Service::find($line['id']);
                    if ($service) {
                        $service->update(['status' => 'completed']);
                    } else {
                        throw new \Exception("Service with ID {$line['id']} not found.");
                    }
                }
            }
        });
    
        return redirect()->route('transactions.index')
                         ->with('success', 'Transaksi berhasil disimpan');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['transactionItems.itemable','customer','user']);
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        DB::transaction(function() use ($transaction) {
            foreach ($transaction->transactionItems as $ti) {
                if ($ti->itemable_type === Item::class) {
                    Item::find($ti->itemable_id)->increment('stock', $ti->quantity);
                }
                if ($ti->itemable_type === Service::class) {
                    Service::find($ti->itemable_id)->update(['status'=>'pending']);
                }
            }
            $transaction->delete();
        });

        return redirect()->route('transactions.index')
                         ->with('success','Transaksi berhasil dihapus');
    }
}
