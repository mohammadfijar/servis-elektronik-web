@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kategori
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
        </div>
        <div class="card-body">
            <div class="mb-4">
            <form method="GET" action="{{ route('categories.index') }}" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="name" class="form-control" 
                        placeholder="Cari nama kategori" 
                        value="{{ request('name') }}">
                </div>
                <div class="form-group mr-2">
                <input type="text" name="date_range" class="form-control pr-3" id="dateRangePicker">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Reset</a>
            </form>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Dibuat Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('d M Y H:i') }}</td>
                            @if(auth()->user()->hasRole('admin'))
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-circle btn-sm mr-2">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="delete-form">
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
                            <td colspan="3" class="text-center">Belum ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> <!-- Tambahkan ini -->
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
$(function() {
    $('#dateRangePicker').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
            applyLabel: 'Terapkan',
            cancelLabel: 'Batal',
        },
        drops: "down",
        opens: "right"
    });
});
</script>
@endpush