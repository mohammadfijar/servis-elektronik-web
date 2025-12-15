@extends('layouts.app')

@section('title','Detail Supplier')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-info text-white">
      <h5>Detail Supplier</h5>
    </div>
    <div class="card-body">
      <table class="table table-borderless mb-0">
        <tr><th>Nama</th><td>: {{ $supplier->name }}</td></tr>
        <tr><th>Contact Person</th><td>: {{ $supplier->contact }}</td></tr>
        <tr><th>Email</th><td>: {{ $supplier->email }}</td></tr>
        <tr><th>Dibuat</th><td>: {{ $supplier->created_at->format('d M Y H:i') }}</td></tr>
        <tr><th>Diupdate</th><td>: {{ $supplier->updated_at->format('d M Y H:i') }}</td></tr>
      </table>
    </div>
    <div class="card-footer">
      <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
      <a href="{{ route('suppliers.edit',$supplier) }}" class="btn btn-warning">Edit</a>
    </div>
  </div>
</div>
@endsection
