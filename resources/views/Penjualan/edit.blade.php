@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Penjualan</h1>

    <form method="POST" action="{{ route('penjualan.update', $penjualan->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="produk_id">Produk</label>
            <select name="produk_id" class="form-control" required>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}" {{ $produk->id == $penjualan->produk_id ? 'selected' : '' }}>
                        {{ $produk->nama }} (Stok: {{ $produk->stok }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" value="{{ $penjualan->jumlah }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection