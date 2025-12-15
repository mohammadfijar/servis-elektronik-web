@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pelanggan</h1>
        <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pelanggan
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pelanggan</h6>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <form method="GET" action="{{ route('customers.index') }}" class="form-inline">
                    <div class="form-group mr-2">
                        <input type="text" name="name" class="form-control" 
                            placeholder="Cari nama pelanggan" 
                            value="{{ request('name') }}">
                    </div>
                    <div class="form-group mr-2">
                        <input type="text" name="NIK" class="form-control" 
                            placeholder="Cari nik pelanggan" 
                            value="{{ request('NIK') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Filter</button>
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Reset</a>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>NIK</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->telephone }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->NIK }}</td>
                            @if(auth()->user()->hasRole('admin'))
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-circle btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="delete-form">
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
                            <td colspan="5" class="text-center">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
                <div class="mt-3">
    {{ $customers->links('vendor.pagination.text-only') }}
  </div>
        
        </div>
    </div>
</div>
@endsection