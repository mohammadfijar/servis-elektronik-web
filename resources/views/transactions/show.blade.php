@extends('layouts.app')
@section('title','Detail Transaksi')

@section('content')
<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h5>Detail Transaksi: {{ $transaction->invoice_no }}</h5>
    </div>
    <div class="card-body">
      <p><strong>Pelanggan:</strong> {{ $transaction->customer->name ?? 'Umum' }}</p>
      <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>
      <table class="table table-sm">
        <thead><tr><th>Item</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead>
        <tbody>
          @foreach($transaction->transactionItems as $line)
          <tr>
            <td>{{ $line->itemable->name }}</td>
            <td>{{ $line->quantity }}</td>
            <td>Rp {{ number_format($line->price,2) }}</td>
            <td>Rp {{ number_format($line->subtotal,2) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <p><strong>Total:</strong> Rp {{ number_format($transaction->total,2) }}</p>
      <p><strong>Diskon:</strong> Rp {{ number_format($transaction->discount,2) }}</p>
      <p><strong>Grand Total:</strong> Rp {{ number_format($transaction->grand_total,2) }}</p>
      <p><strong>Paid:</strong> Rp {{ number_format($transaction->paid,2) }}</p>
      <p><strong>Change:</strong> Rp {{ number_format($transaction->change,2) }}</p>
      <p><strong>Metode:</strong> {{ ucfirst($transaction->payment_method) }}</p>
    </div>
    <div class="card-footer">
      <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
@endsection
