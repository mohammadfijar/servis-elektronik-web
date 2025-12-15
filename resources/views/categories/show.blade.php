@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Detail Kategori</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th>Nama</th>
                    <td>: {{ $category->name }}</td>
                </tr>
                <tr>
                    <th>Dibuat Tanggal</th>
                    <td>: {{ $category->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>: {{ $category->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection