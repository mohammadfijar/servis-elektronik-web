@extends('layouts.app')

@section('title', 'Buat Transaksi Baru')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5>Buat Transaksi Baru</h5>
    </div>
    <div class="card-body">
      <form id="tx-form" method="POST" action="{{ route('transactions.store') }}">
        @csrf

        <div class="form-group">
          <label for="invoice_no">Invoice No</label>
          <input type="text" name="invoice_no" id="invoice_no" class="form-control" value="{{ $invoiceNo }}" readonly>
        </div>

        <div class="form-group">
          <label for="customer_id">Pelanggan (opsional)</label>
          <select name="customer_id" id="customer_id" class="form-control">
            <option value="">- Tetap Umum -</option>
            @foreach($customers as $c)
            <option value="{{ $c->id }}" {{ old('customer_id') == $c->id ? 'selected' : '' }}>
              {{ $c->name }}
            </option>
            @endforeach
          </select>
        </div>

        <hr>

        <h6>Lines (Barang / Service)</h6>
        <table class="table table-sm" id="lines-table">
          <thead>
            <tr>
              <th>Type</th>
              <th>Item / Service</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Subtotal</th>
              <th>
                <button type="button" id="add-line" class="btn btn-sm btn-success">+</button>
              </th>
            </tr>
          </thead>
          <tbody>
            @if(old('lines'))
              @foreach(old('lines') as $index => $line)
                <tr>
                  <td>
                    <select name="lines[{{ $index }}][type]" class="form-control line-type">
                      <option value="item" {{ $line['type'] == 'item' ? 'selected' : '' }}>Item</option>
                      <option value="service" {{ $line['type'] == 'service' ? 'selected' : '' }}>Service</option>
                    </select>
                  </td>
                  <td>
                    <select name="lines[{{ $index }}][id]" class="form-control line-id">
                      {!! $line['type'] == 'item' 
                          ? $items->map(fn($i) => "<option value='{$i->id}' " . ($i->id == $line['id'] ? 'selected' : '') . " data-price='{$i->selling_price}'>{$i->name} - Rp " . number_format($i->selling_price, 2) . "</option>")->join('')
                          : $services->map(fn($s) => "<option value='{$s->id}' " . ($s->id == $line['id'] ? 'selected' : '') . " data-price='{$s->service_fee}'>{$s->item->name} (Servis) - Rp " . number_format($s->service_fee, 2) . "</option>")->join('') !!}
                    </select>
                  </td>
                  <td>
                    <input type="number" name="lines[{{ $index }}][quantity]" class="form-control line-qty" value="{{ $line['quantity'] }}" min="1">
                  </td>
                  <td>
                    <input type="number" name="lines[{{ $index }}][price]" class="form-control line-price" value="{{ $line['price'] }}" step="0.01">
                  </td>
                  <td class="line-subtotal text-end">{{ number_format($line['quantity'] * $line['price'], 2) }}</td>
                  <td><button type="button" class="btn btn-sm btn-danger remove-line">×</button></td>
                </tr>
              @endforeach
            @else
              <tr>
                <td>
                  <select name="lines[0][type]" class="form-control line-type">
                    <option value="item">Item</option>
                    <option value="service">Service</option>
                  </select>
                </td>
                <td>
                  <select name="lines[0][id]" class="form-control line-id">
                    @foreach($items as $it)
                      <option value="{{ $it->id }}" data-price="{{ $it->selling_price }}">{{ $it->name }} - Rp {{ number_format($it->selling_price, 2) }}</option>
                    @endforeach
                  </select>
                </td>
                <td><input type="number" name="lines[0][quantity]" class="form-control line-qty" value="1" min="1"></td>
                <td><input type="number" name="lines[0][price]" class="form-control line-price" value="0" step="0.01"></td>
                <td class="line-subtotal text-end">0.00</td>
                <td><button type="button" class="btn btn-sm btn-danger remove-line">×</button></td>
              </tr>
            @endif
          </tbody>
          <tfoot>
            <tr>
              <th colspan="4" class="text-end">Total:</th>
              <th id="grand-total" class="text-end">0.00</th>
              <th></th>
            </tr>
          </tfoot>
        </table>

        <div class="row g-3">
          <div class="col-md-4">
            <label for="discount" class="form-label">Diskon</label>
            <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount', 0) }}" min="0" step="0.01">
          </div>
          <div class="col-md-4">
            <label for="paid" class="form-label">Bayar</label>
            <input type="number" name="paid" id="paid" class="form-control" value="{{ old('paid', 0) }}" min="0" step="0.01" required>
          </div>
          <div class="col-md-4">
            <label for="payment_method" class="form-label">Metode Bayar</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
              <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
              <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
              <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer</option>
              <option value="ewallet" {{ old('payment_method') == 'ewallet' ? 'selected' : '' }}>eWallet</option>
            </select>
          </div>
        </div>

        <hr>

        <div class="text-right">
          <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
const items = @json($items);
const services = @json($services);

function renderOption(type) {
  let arr = type === 'item' ? items : services;
  return arr.map(o => {
    const price = type === 'item' ? o.selling_price : o.service_fee;
    const name = type === 'item' ? o.name : o.item.name + " (Servis)";
    const priceFormatted = (typeof price === 'number' && !isNaN(price)) ? price.toFixed(2) : '0.00';
    return `<option value="${o.id}" data-price="${price}">${name} - Rp ${priceFormatted}</option>`;
  }).join('');
}

function recalcRow(row) {
  const qty = parseFloat(row.querySelector('.line-qty').value) || 0;
  const price = parseFloat(row.querySelector('.line-price').value) || 0;
  const subtotal = qty * price;
  row.querySelector('.line-subtotal').textContent = subtotal.toFixed(2);
  recalcTotal();
}

function recalcTotal() {
  let total = 0;
  document.querySelectorAll('#lines-table tbody tr').forEach(row => {
    const qty = parseFloat(row.querySelector('.line-qty').value) || 0;
    const price = parseFloat(row.querySelector('.line-price').value) || 0;
    total += qty * price;
  });
  document.getElementById('grand-total').textContent = total.toFixed(2);
}

let lineIndex = document.querySelectorAll('#lines-table tbody tr').length;

function addLine(old = { type: 'item', id: '', quantity: 1, price: 0 }) {
  let index = lineIndex++;
  let row = document.createElement('tr');
  row.innerHTML = `
    <td>
      <select name="lines[${index}][type]" class="form-control line-type">
        <option value="item" ${old.type === 'item' ? 'selected' : ''}>Item</option>
        <option value="service" ${old.type === 'service' ? 'selected' : ''}>Service</option>
      </select>
    </td>
    <td>
      <select name="lines[${index}][id]" class="form-control line-id">
        ${renderOption(old.type)}
      </select>
    </td>
    <td><input type="number" name="lines[${index}][quantity]" class="form-control line-qty" value="${old.quantity}" min="1"></td>
    <td><input type="number" name="lines[${index}][price]" class="form-control line-price" value="${old.price}" step="0.01"></td>
    <td class="line-subtotal text-end">0.00</td>
    <td><button type="button" class="btn btn-sm btn-danger remove-line">×</button></td>
  `;
  
  document.querySelector('#lines-table tbody').append(row);
  
  const idSelect = row.querySelector('.line-id');
  if (idSelect.options.length > 0) {
    idSelect.selectedIndex = 0; // Pilih opsi pertama secara eksplisit
    const price = parseFloat(idSelect.options[0].getAttribute('data-price')) || 0;
    row.querySelector('.line-price').value = price.toFixed(2);
  } else {
    row.querySelector('.line-price').value = '0.00';
  }
  
  recalcRow(row);
}

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('add-line').onclick = () => addLine();

  document.querySelector('#lines-table').addEventListener('input', e => {
    const row = e.target.closest('tr');
    if (row) recalcRow(row);
  });

  document.querySelector('#lines-table').addEventListener('change', e => {
    const target = e.target;
    if (target.classList.contains('line-type')) {
      const row = target.closest('tr');
      const type = target.value;
      const idSelect = row.querySelector('.line-id');
      idSelect.innerHTML = renderOption(type);
      if (idSelect.options.length > 0) {
        idSelect.selectedIndex = 0; // Pilih opsi pertama
        const price = parseFloat(idSelect.options[0].getAttribute('data-price')) || 0;
        row.querySelector('.line-price').value = price.toFixed(2);
      } else {
        row.querySelector('.line-price').value = '0.00';
      }
      recalcRow(row);
    } else if (target.classList.contains('line-id')) {
      const price = parseFloat(target.selectedOptions[0].getAttribute('data-price')) || 0;
      const row = target.closest('tr');
      row.querySelector('.line-price').value = price.toFixed(2);
      recalcRow(row);
    }
  });

  document.querySelectorAll('#lines-table tbody tr').forEach(row => {
    const idSelect = row.querySelector('.line-id');
    const selectedOption = idSelect.options[idSelect.selectedIndex];
    if (selectedOption) {
      const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
      row.querySelector('.line-price').value = price.toFixed(2);
    }
    recalcRow(row);
  });

  document.querySelector('#lines-table').addEventListener('click', e => {
    if (e.target.matches('.remove-line')) {
      e.target.closest('tr').remove();
      recalcTotal();
    }
  });

  recalcTotal();
});
</script>
@endpush