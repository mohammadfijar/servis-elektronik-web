<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Models\Item;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class ServiceController extends Controller
{

    public function index(Request $request)
    {
        $query = Service::with(['item', 'customer', 'staff']);

        if ($request->filled('item_name')) {
            $query->whereHas('item', fn($q) => $q->where('name','like',"%{$request->item_name}%"));
        }
        if ($request->filled('customer_name')) {
            $query->whereHas('customer', fn($q) => $q->where('name','like',"%{$request->customer_name}%"));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('service_date')) {
            $query->whereDate('service_date', $request->service_date);
        }

        $services = $query->latest()
                          ->simplePaginate(10)
                          ->appends($request->only(['item_name','customer_name','status','service_date']));

        return view('services.index', compact('services'));
    }

    public function exportXlsx(Request $request)
    {
        $query = Service::with(['item', 'customer', 'staff']);
        if ($request->filled('item_name')) {
            $query->whereHas('item', fn($q) => $q->where('name','like',"%{$request->item_name}%"));
        }
        if ($request->filled('customer_name')) {
            $query->whereHas('customer', fn($q) => $q->where('name','like',"%{$request->customer_name}%"));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('service_date')) {
            $query->whereDate('service_date', $request->service_date);
        }

        $fileName = 'services_' . now()->format('Ymd_His') . '.xlsx';

        return Response::streamDownload(function() use ($query) {
            $writer = WriterEntityFactory::createXLSXWriter();
            $writer->openToFile('php://output');

            // Header row
            $writer->addRow(WriterEntityFactory::createRowFromArray([
                'ID', 'Item', 'Customer', 'Staff', 'Description', 'Diagnosis', 'Action Taken', 'Fee', 'Service Date', 'Status'
            ]));

            $query->chunk(500, function($services) use ($writer) {
                foreach ($services as $svc) {
                    $writer->addRow(WriterEntityFactory::createRowFromArray([
                        $svc->id,
                        $svc->item?->name ?? '-',
                        $svc->customer?->name ?? '-',
                        $svc->staff?->name ?? '-',
                        $svc->description,
                        $svc->diagnosis,
                        $svc->action_taken,
                        $svc->service_fee,
                        $svc->service_date 
                            ? \Carbon\Carbon::parse($svc->service_date)->format('Y-m-d') 
                            : '-',
                        ucfirst(str_replace('_',' ', $svc->status)),
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
        // Ambil hanya item dengan kategori 'service'
        $items = Item::whereHas('category', function ($query) {
            $query->where('name', 'servis');
        })->get();
        $customers = Customer::all();

        return view('services.create', compact('items', 'customers'));
    }


    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        $data['staff_id'] = Auth::id();
        Service::create($data);

        return redirect()->route('services.index')
                         ->with('success','Service berhasil ditambahkan');
    }

    public function show(Service $service)
    {
        $service->load(['item','customer','staff']);
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $items = Item::all();
        $customers = Customer::all();
        return view('services.edit', compact('service','items','customers'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->validated();
        $service->update($data);

        return redirect()->route('services.index')
                         ->with('success','Service berhasil diupdate');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')
                         ->with('success','Service berhasil dihapus');
    }
}
