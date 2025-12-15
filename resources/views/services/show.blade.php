@extends('layouts.app')

@section('title', 'Detail Service')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Detail Service</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th>Barang</th>
                    <td>: {{ $service->item->name }}</td>
                </tr>
                <tr>
                    <th>Pelanggan</th>
                    <td>: {{ $service->customer?->name ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>: {{ $service->description }}</td>
                </tr>
                <tr>
                    <th>Tanggal Service</th>
                    <td>{{ \Carbon\Carbon::parse($service->service_date)->format('d M Y') }}</td>

                </tr>
                <tr>
                    <th>Status</th>
                    <td>:
                        @switch($service->status)
                            @case('pending')
                                <span class="badge bg-secondary">Pending</span>
                                @break
                            @case('in_progress')
                                <span class="badge bg-warning text-dark">Diproses</span>
                                @break
                            @case('completed')
                                <span class="badge bg-success">Selesai</span>
                                @break
                            @case('waiting_parts')
                                <span class="badge badge-success">Menuggu Sparepart</span>
                                @break
                        @endswitch
                    </td>
                </tr>
                <tr>
                    <th>Dibuat Tanggal</th>
                    <td>: {{ $service->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diupdate</th>
                    <td>: {{ $service->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('services.edit', $service) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection