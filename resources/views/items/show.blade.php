@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Detail Barang</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th>Kategori</th>
                    <td>: {{ $item->category->name }}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>: {{ $item->name }}</td>
                </tr>
                <tr>
                    <th>Merk</th>
                    <td>: {{ $item->brand }}</td>
                </tr>
                <tr>
                    <th>Harga Beli</th>
                    <td>: Rp {{ number_format($item->purchase_price, 2) }}</td>
                </tr>
                <tr>
                    <th>Harga Jual</th>
                    <td>: Rp {{ number_format($item->selling_price, 2) }}</td>
                </tr>
                <tr>
                    <th>Satuan</th>
                    <td>: {{ $item->satuan_barang }}</td>
                </tr>
                <tr>
                    <th>Stok</th>
                    <td>: {{ $item->stock }}</td>
                </tr>
                <tr>
                    <th>Dibuat Tanggal</th>
                    <td>: {{ $item->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>: {{ $item->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('items.edit', $item) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection