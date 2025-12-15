@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Penjualan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualans as $index => $penjualan)
            <tr>
                <td>{{ $index + $penjualans->firstItem() }}</td>
                <td>{{ $penjualan->produk->name }}</td>
                <td>{{ $penjualan->jumlah }}</td>
                <td>Rp{{ number_format($penjualan->total_harga, 2, ',', '.') }}</td>
                <td>{{ $penjualan->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $penjualans->links() }}
</div>
@endsection