@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
        <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
            </div>
            <div class="card-body">
            <div class="mb-4">
            <form method="GET" action="{{ route('items.index') }}" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="name" class="form-control" 
                        placeholder="Cari nama barang" 
                        value="{{ request('name') }}">
                </div>
                <div class="form-group mr-2">
                    <input type="text" name="brand" class="form-control" 
                        placeholder="Cari merk" 
                        value="{{ request('brand') }}">
                </div>
                <div class="form-group mr-2">
                    <select name="category_id" class="form-control">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-2">
                    <div class="form-check">
                        <input type="checkbox" name="zero_stock" value="1" id="zeroStockFilter"
                            {{ request('zero_stock') == 1 ? 'checked' : '' }} class="form-check-input">
                        <label for="zeroStockFilter" class="form-check-label">Stok Kosong</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Reset</a>
            </form>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Merk</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>Rp {{ number_format($item->purchase_price, 2) }}</td>
                            <td>Rp {{ number_format($item->selling_price, 2) }}</td>
                            <td>{{ $item->stock }}</td>
                            @if(auth()->user()->hasRole('admin'))
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('items.edit', $item) }}" class="btn btn-warning btn-circle btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('items.destroy', $item) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin hapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
@endsection