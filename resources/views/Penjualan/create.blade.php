@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Penjualan</h1>

    <form method="POST" action="{{ route('penjualan.store') }}">
        @csrf

        <div class="form-group">
            <label for="produk_id">Produk</label>
            <select name="items_id" class="form-control" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->name }} (Stok: {{ $produk->stock }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
