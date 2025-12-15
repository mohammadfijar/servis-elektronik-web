@extends('layouts.app')

@section('title', 'Buat Service Baru')

@section('content')
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5>Buat Service Baru</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('services.store') }}">
            @csrf

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="item_id">Barang</label>
                <select name="item_id" id="item_id"
                        class="form-control @error('item_id') is-invalid @enderror" required>
                  <option value="">— Pilih Barang —</option>
                  @foreach($items as $item)
                    <option value="{{ $item->id }}"
                      {{ old('item_id') == $item->id ? 'selected' : '' }}>
                      {{ $item->name }}
                    </option>
                  @endforeach
                </select>
                @error('item_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="customer_id">Pelanggan (opsional)</label>
                <select name="customer_id" id="customer_id"
                        class="form-control @error('customer_id') is-invalid @enderror">
                  <option value="">— Umum —</option>
                  @foreach($customers as $customer)
                    <option value="{{ $customer->id }}"
                      {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                      {{ $customer->name ?? '-' }}
                    </option>
                  @endforeach
                </select>
                @error('customer_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label for="description">Deskripsi</label>
              <textarea name="description" id="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror"
                        required>{{ old('description') }}</textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="diagnosis">Diagnosis (opsional)</label>
                <input type="text" name="diagnosis" id="diagnosis"
                       class="form-control @error('diagnosis') is-invalid @enderror"
                       value="{{ old('diagnosis') }}">
                @error('diagnosis')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="action_taken">Action Taken (opsional)</label>
                <input type="text" name="action_taken" id="action_taken"
                       class="form-control @error('action_taken') is-invalid @enderror"
                       value="{{ old('action_taken') }}">
                @error('action_taken')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="service_fee">Biaya Servis (Rp)</label>
                <input type="number" name="service_fee" id="service_fee"
                       class="form-control @error('service_fee') is-invalid @enderror"
                       value="{{ old('service_fee', 0) }}" min="0" step="0.01" required>
                @error('service_fee')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="service_date">Tanggal Service</label>
                <input type="date" name="service_date" id="service_date"
                       class="form-control @error('service_date') is-invalid @enderror"
                       value="{{ old('service_date') }}" required>
                @error('service_date')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label for="status">Status</label>
              <select name="status" id="status"
                      class="form-control @error('status') is-invalid @enderror" required>
                <option value="pending"      {{ old('status')=='pending'      ? 'selected':'' }}>Pending</option>
                <option value="in_progress"  {{ old('status')=='in_progress'  ? 'selected':'' }}>Diproses</option>
                <option value="waiting_parts"{{ old('status')=='waiting_parts'? 'selected':'' }}>Menunggu Sparepart</option>
                <option value="completed"    {{ old('status')=='completed'    ? 'selected':'' }}>Selesai</option>
                <option value="cancelled"    {{ old('status')=='cancelled'    ? 'selected':'' }}>Batal</option>
              </select>
              @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Simpan Service</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
