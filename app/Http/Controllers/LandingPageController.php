<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $items = Item::all();

        return view('landing_page', compact('customers', 'items'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'nullable|array',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'services' => 'nullable|array',
            'services.*.description' => 'required|string',
            'services.*.item_id' => 'required|exists:items,id',
            // ...tambahkan validasi lain jika diperlukan
        ]);

        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'invoice_no' => 'INV-' . now()->timestamp,
                'customer_id' => $request->customer_id,
                'staff_id' => auth()->id(),
                'total' => 0,
                'paid' => 0,
                'change' => 0,
                'discount' => 0,
                'grand_total' => 0,
                'payment_method' => 'cash',
                'status' => 'pending',
            ]);

            $grandTotal = 0;

            // Simpan item sebagai TransactionItem
            foreach ($request->items ?? [] as $itemData) {
                $item = Item::findOrFail($itemData['id']);
                $quantity = $itemData['quantity'];
                $subtotal = $item->selling_price * $quantity;
                $grandTotal += $subtotal;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'itemable_id' => $item->id,
                    'itemable_type' => Item::class,
                    'quantity' => $quantity,
                    'price' => $item->selling_price,
                    'subtotal' => $subtotal,
                ]);
            }

            // Simpan service sebagai Service model + TransactionItem
            foreach ($request->services ?? [] as $serviceData) {
                $service = Service::create([
                    'item_id' => $serviceData['item_id'],
                    'customer_id' => $request->customer_id,
                    'staff_id' => auth()->id(),
                    'description' => $serviceData['description'],
                    'diagnosis' => $serviceData['diagnosis'] ?? '',
                    'action_taken' => $serviceData['action_taken'] ?? '',
                    'service_fee' => $serviceData['service_fee'] ?? 0,
                    'service_date' => now(),
                    'status' => 'ordered',
                ]);

                $grandTotal += $service->service_fee;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'itemable_id' => $service->id,
                    'itemable_type' => Service::class,
                    'quantity' => 1,
                    'price' => $service->service_fee,
                    'subtotal' => $service->service_fee,
                ]);
            }

            $transaction->update([
                'total' => $grandTotal,
                'grand_total' => $grandTotal,
            ]);

            DB::commit();

            return response()->json(['message' => 'Order berhasil dibuat', 'transaction' => $transaction]);

        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['message' => 'Gagal membuat order', 'error' => $e->getMessage()], 500);
        }
    }

}
