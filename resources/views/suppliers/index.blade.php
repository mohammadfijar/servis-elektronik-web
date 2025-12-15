@extends('layouts.app')

@section('title','Daftar Supplier')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 text-gray-800">Daftar Supplier</h1>
  <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm">
    <i class="fas fa-plus"></i> Tambah Supplier
  </a>
</div>

<div class="card shadow mb-4">
  <div class="card-body">
    <form class="form-inline mb-3" method="GET" action="{{ route('suppliers.index') }}">
      <input type="text" name="name" class="form-control mr-2" placeholder="Cari nama" value="{{ request('name') }}">
      <button class="btn btn-primary">Filter</button>
      <a href="{{ route('suppliers.index') }}" class="btn btn-secondary ml-2">Reset</a>
      <a href="{{ route('suppliers.export', request()->only('name')) }}" class="btn btn-success ml-auto">
        <i class="fas fa-file-export"></i> Export XLSX
      </a>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($suppliers as $s)
          <tr>
            <td>{{ $s->name }}</td>
            <td>{{ $s->contact }}</td>
            <td>{{ $s->email }}</td>
            @if(auth()->user()->hasRole('admin'))
            <td>
              <a href="{{ route('suppliers.show',$s) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
              <a href="{{ route('suppliers.edit',$s) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
              <form action="{{ route('suppliers.destroy',$s) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
              </form>
            </td>
            @endif
          </tr>
          @empty
          <tr><td colspan="5" class="text-center">Belum ada supplier</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
        <div class="mt-3">
    {{ $suppliers->links('vendor.pagination.text-only') }}
  </div>
  </div>
</div>
@endsection
