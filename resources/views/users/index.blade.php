@extends('layouts.app')

@section('title','Manajemen User')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 text-gray-800">Manajemen User</h1>
  <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
    <i class="fas fa-user-plus"></i> Tambah User
  </a>
</div>

<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
            <td>
              <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-pen"></i>
              </a>
              <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus user?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="4" class="text-center">Belum ada user</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    <div class="mt-3">    {{ $users->links('vendor.pagination.text-only') }}
</div>
  </div>
</div>
@endsection
