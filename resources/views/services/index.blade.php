@extends('layouts.app')

@section('title', 'Data Service')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Service</h1>
        <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Service
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Service</h6>
            </div>
            <div class="card-body">
            <div class="mb-4">
            <form method="GET" action="{{ route('services.index') }}" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="item_name" class="form-control" 
                        placeholder="Cari nama barang" 
                        value="{{ request('item_name') }}">
                </div>
                <div class="form-group mr-2">
                    <input type="text" name="customer_name" class="form-control" 
                        placeholder="Cari nama pelanggan" 
                        value="{{ request('customer_name') }}">
                </div>
                <div class="form-group mr-2">
                    <select name="status" class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Diproses</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="form-group mr-2">
                    <input type="date" name="service_date" class="form-control" 
                        value="{{ request('service_date') }}">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary mr-2">Reset</a>
                <a href="{{ route('services.export', request()->only(['item_name','customer_name','status','service_date'])) }}"
                    class="btn btn-success">
                    Export ke Excel
                </a>
            </form>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Pelanggan</th>
                            <th>Tanggal Service</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr>
                            <td>{{ $service->item->name }}</td>
                            <td>{{ $service->customer?->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($service->service_date)->format('d M Y') }}</td>
                            <td>
                                @switch($service->status)
                                    @case('pending')
                                        <span class="badge badge-secondary">Pending</span>
                                        @break
                                    @case('in_progress')
                                        <span class="badge badge-warning">Diproses</span>
                                        @break
                                    @case('completed')
                                        <span class="badge badge-success">Selesai</span>
                                        @break
                                    @case('waiting_parts')
                                        <span class="badge badge-success">Menuggu Sparepart</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('services.show', $service) }}" class="btn btn-info btn-circle btn-sm mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('services.edit', $service) }}" class="btn btn-warning btn-circle btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Yakin hapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
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
    {{ $services->links('vendor.pagination.text-only') }}
        </div>
    </div>
</div>
@endsection