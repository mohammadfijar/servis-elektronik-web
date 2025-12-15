@extends('layouts.app')

@section('title','Edit Supplier')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-warning text-white">
      <h5>Edit Supplier</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('suppliers.update',$supplier) }}">
        @csrf @method('PUT')

        <div class="form-group">
          <label for="name">Nama Supplier</label>
          <input type="text" name="name" id="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name',$supplier->name) }}" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label for="contact_person">Contact </label>
          <input type="text" name="contact" id="contact"
                 class="form-control @error('contact') is-invalid @enderror"
                 value="{{ old('contact',$supplier->contact) }}">
          @error('contact')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label for="phone">Telepon</label>
          <input type="text" name="phone" id="phone"
                 class="form-control @error('phone') is-invalid @enderror"
                 value="{{ old('phone',$supplier->phone) }}">
          @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email',$supplier->email) }}">
          @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- <div class="form-group">
          <label for="address">Alamat</label>
          <textarea name="address" id="address"
                    class="form-control @error('address') is-invalid @enderror"
                    rows="3">{{ old('address',$supplier->address) }}</textarea>
          @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div> -->

        <div class="text-right">
          <button type="submit" class="btn btn-warning">Update Supplier</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
