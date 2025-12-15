@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Detail Pelanggan</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th>Nama</th>
                    <td>: {{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: {{ $customer->address }}</td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>: {{ $customer->telephone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: {{ $customer->email }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>: {{ $customer->NIK }}</td>
                </tr>
                <tr>
                    <th>Dibuat Tanggal</th>
                    <td>: {{ $customer->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>: {{ $customer->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection