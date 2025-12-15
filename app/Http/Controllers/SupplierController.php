<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{

    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        if ($request->filled('contact_person')) {
            $query->where('contact', 'like', "%{$request->contact}%");
        }

        $suppliers = $query->latest()
                           ->simplePaginate(10)
                           ->appends($request->only(['name', 'contact_person']));

        return view('suppliers.index', compact('suppliers'));
    }

    public function exportXlsx(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        if ($request->filled('contact')) {
            $query->where('contact_person', 'like', "%{$request->contact}%");
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', "%{$request->phone}%");
        }

        $fileName = 'suppliers_' . now()->format('Ymd_His') . '.xlsx';

        return Response::streamDownload(function () use ($query) {
            $writer = WriterEntityFactory::createXLSXWriter();
            $writer->openToFile('php://output');

            $writer->addRow(WriterEntityFactory::createRowFromArray([
                'ID', 'Nama Supplier', 'Contact Person', 'Telepon', 'Alamat', 'Email'
            ]));

            $query->chunk(500, function ($suppliers) use ($writer) {
                foreach ($suppliers as $supplier) {
                    $writer->addRow(WriterEntityFactory::createRowFromArray([
                        $supplier->id,
                        $supplier->name,
                        $supplier->contact_person,
                        $supplier->phone,
                        $supplier->address,
                        $supplier->email,
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
        return view('suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->validated());
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier berhasil diupdate.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier berhasil dihapus.');
    }
}
