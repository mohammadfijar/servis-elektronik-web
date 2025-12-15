<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Category;
use App\Models\StockHistory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('category');

        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        if ($request->filled('brand')) {
            $query->where('brand', 'like', "%{$request->brand}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('zero_stock') && $request->zero_stock == 1) {
            $query->where('stock', 0);
        }

        $categories = Category::all();
        $items = $query->latest()
            ->simplePaginate(10)
            ->appends($request->only(['name', 'brand', 'category_id', 'zero_stock']));

        return view('items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories')); 
    }

    public function store(StoreItemRequest $request)
    {
        $data = $request->validated();

        // Hitung harga jual otomatis (markup 20%)
        $data['selling_price'] = $data['purchase_price'] * 1.2;

        // Upload foto barang jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        // Buat item
        $item = Item::create($data);

        // Log perubahan stok awal
        StockHistory::create([
            'item_id'   => $item->id,
            'old_stock' => 0,
            'new_stock' => $item->stock,
            'reason'    => 'Initial stock',
        ]);

        return redirect()->route('items.index')
                         ->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $data = $request->validated();

        // Hitung ulang harga jual
        $data['selling_price'] = $data['purchase_price'] * 1.2;

        // Upload foto baru jika ada
        if ($request->hasFile('image')) {
            // Hapus foto lama
            if ($item->image && \Storage::disk('public')->exists($item->image)) {
                \Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        // Cek perubahan stok
        $oldStock = $item->stock;

        // Update item
        $item->update($data);

        // Jika stok berubah, log perubahan
        if ($oldStock !== $data['stock']) {
            StockHistory::create([
                'item_id'   => $item->id,
                'old_stock' => $oldStock,
                'new_stock' => $data['stock'],
                'reason'    => 'Manual stock update',
            ]);
        }

        return redirect()->route('items.index')
                         ->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')
                         ->with('success', 'Barang berhasil dihapus');
    }
}
