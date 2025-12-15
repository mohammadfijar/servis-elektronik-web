<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Item;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Tampilkan daftar penjualan
     */
    public function index()
    {
        $penjualans = Penjualan::with('produk')->latest()->paginate(10);
        return view('penjualan.index', compact('penjualans'));
    }

    /**
     * Form tambah penjualan
     */
    public function create()
    {
        $produks = Item::where('stock', '>', 0)->get();
        return view('penjualan.create', compact('produks'));
    }

    /**
     * Simpan penjualan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'items_id' => 'required|exists:items,id',
            'jumlah'   => 'required|integer|min:1',
        ]);

        $produk = Item::findOrFail($request->items_id);
        $totalHarga = $produk->selling_price * $request->jumlah;

        Penjualan::create([
            'items_id'   => $produk->id,
            'jumlah'     => $request->jumlah,
            'total_harga'=> $totalHarga,
        ]);

        $produk->decrement('stock', $request->jumlah);


        return redirect()->route('penjualan.index')
                         ->with('success', 'Penjualan berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail penjualan
     */
    public function show(Penjualan $penjualan)
    {
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Form edit penjualan
     */
    public function edit(Penjualan $penjualan)
    {
        $produks = Item::all();
        return view('penjualan.edit', compact('penjualan', 'produks'));
    }

    /**
     * Update penjualan
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'items_id' => 'required|exists:items,id',
            'jumlah'   => 'required|integer|min:1',
        ]);

        $penjualan->produk->increment('stock', $penjualan->jumlah);

        $produk = Item::findOrFail($request->items_id);
        $totalHarga = $produk->selling_price * $request->jumlah;

        $penjualan->update([
            'items_id'   => $produk->id,
            'jumlah'     => $request->jumlah,
            'total_harga'=> $totalHarga,
        ]);

        $produk->decrement('stock', $request->jumlah);


        return redirect()->route('penjualan.index')
                         ->with('success', 'Penjualan berhasil diperbarui.');
    }

    /**
     * Hapus penjualan
     */
    public function destroy(Penjualan $penjualan)
    {
        // Kembalikan stok
        $penjualan->produk->increment('stok', $penjualan->jumlah);

        $penjualan->delete();

        return redirect()->route('penjualan.index')
                         ->with('success', 'Penjualan berhasil dihapus.');
    }
}