@extends('layouts.app')

@section('title','Tambah User')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5>Tambah User</h5>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group mb-3">
          <label for="name">Nama</label>
          <input type="text" name="name" id="name"
                 class="form-control @error('name') is-invalid @enderror"
                 value="{{ old('name') }}" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group mb-3">
          <label for="email">Email</label>
          <input type="email" name="email" id="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email') }}" required>
          @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group mb-3">
          <label for="password">Password</label>
          <input type="password" name="password" id="password"
                 class="form-control @error('password') is-invalid @enderror" required>
          @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group mb-3">
          <label for="password_confirmation">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation"
                 class="form-control" required>
        </div>

        <div class="form-group mb-3">
          <label>Role</label>
          @foreach($roles as $role)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}"
                     {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="role_{{ $role->id }}">
                {{ ucfirst($role->name) }}
              </label>
            </div>
          @endforeach
          @error('roles') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-between">
          <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan User</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
