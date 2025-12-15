@extends('layouts.app')

@section('title','Data Transaksi')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
  <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">
    <i class="fas fa-plus"></i> Buat Transaksi
  </a>
</div>

<div class="mb-4">
  <form class="form-inline" method="GET" action="{{ route('transactions.index') }}">
    <input type="text" name="invoice_no" class="form-control mr-2" placeholder="Invoice No" value="{{ request('invoice_no') }}">
    <input type="text" name="customer_name" class="form-control mr-2" placeholder="Nama Pelanggan" value="{{ request('customer_name') }}">
    <input type="date" name="date_from" class="form-control mr-2" value="{{ request('date_from') }}">
    <input type="date" name="date_to" class="form-control mr-2" value="{{ request('date_to') }}">
    <button class="btn btn-primary mr-2">Filter</button>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Reset</a>
    <a href="{{ route('transactions.export', request()->only(['invoice_no','customer_name','date_from','date_to'])) }}"
       class="btn btn-success ml-2">
       <i class="fas fa-file-export"></i> Export
    </a>
  </form>
</div>

<div class="card shadow mb-4">
  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Invoice</th><th>Pelanggan</th><th>Total</th><th>Dibayar</th><th>Change</th><th>Tanggal</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($transactions as $tx)
        <tr>
          <td>{{ $tx->invoice_no }}</td>
          <td>{{ $tx->customer->name ?? 'Umum' }}</td>
          <td>Rp {{ number_format($tx->grand_total,2) }}</td>
          <td>Rp {{ number_format($tx->paid,2) }}</td>
          <td>Rp {{ number_format($tx->change,2) }}</td>
          <td>{{ $tx->created_at->format('Y-m-d') }}</td>
          @if(auth()->user()->hasRole('admin'))
          <td>
            <a href="{{ route('transactions.show',$tx) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
            <form action="{{ route('transactions.destroy',$tx) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form>
          </td>
          @endif
        </tr>
        @empty
        <tr><td colspan="7" class="text-center">Belum ada data</td></tr>
        @endforelse
      </tbody>
    </table>
    <div class="mt-3">
    {{ $transactions->links('vendor.pagination.text-only') }}
  </div>
  </div>
</div>
@endsection
