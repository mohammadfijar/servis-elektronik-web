@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Edit Service</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('services.update', $service) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Barang</label>
                                <select name="item_id" class="form-control @error('item_id') is-invalid @enderror" required>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" {{ $service->item_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label>Pelanggan (Opsional)</label>
                                <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $service->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $service->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
    <label>Diagnosis</label>
    <textarea name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror">{{ old('diagnosis', $service->diagnosis) }}</textarea>
    @error('diagnosis')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Tindakan</label>
    <textarea name="action_taken" class="form-control @error('action_taken') is-invalid @enderror">{{ old('action_taken', $service->action_taken) }}</textarea>
    @error('action_taken')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Biaya Service</label>
    <input type="number" name="service_fee" class="form-control @error('service_fee') is-invalid @enderror" value="{{ old('service_fee', $service->service_fee) }}" step="0.01" min="0" required>
    @error('service_fee')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Tanggal Service</label>
                                <input type="date" name="service_date" class="form-control @error('service_date') is-invalid @enderror" value="{{ old('service_date', \Carbon\Carbon::parse($service->service_date)->format('Y-m-d')) }}" required>
                                @error('service_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="pending" {{ $service->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ $service->status == 'in_progress' ? 'selected' : '' }}>Diproses</option>
                                    <option value="completed" {{ $service->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection