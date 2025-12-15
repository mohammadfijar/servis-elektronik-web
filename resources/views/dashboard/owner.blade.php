@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard Owner</h1>
</div>

<div class="row">
@component('components.dashboard-card', [
    'title' => 'Kategori', 
    'count' => $categoriesCount, 
    'icon' => 'fas fa-tags', 
    'color' => 'warning',
    'url' => route('categories.index')
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Barang',
    'count' => $itemsCount,
    'icon' => 'fas fa-boxes', 
    'color' => 'primary',
    'url' => route('items.index')
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Pelanggan',
    'count' => $customersCount,
    'icon' => 'fas fa-users', 
    'color' => 'info',
    'url' => route('customers.index')
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Transaksi',
    'count' => $totalTransactions,
    'icon' => 'fas fa-receipt', 
    'color' => 'success',
    'url' => route('transactions.index')
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Pendapatan',
    'count' => 'Rp '.number_format($totalRevenue,0,',','.'),
    'icon' => 'fas fa-coins',
    'color' => 'success',
    'url' => route('transactions.index')
  ])@endcomponent

  @component('components.dashboard-card', [
    'title' => 'Service',
    'count' => $totalServices, 
    'icon' => 'fas fa-tools',
    'color' => 'secondary',
    'url' => route('services.index')
  ])@endcomponent
</div>
<div class="row mt-4">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Grafik Pendapatan Tahunan</h6>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konversi data PHP ke JavaScript
        const revenueData = @json($revenueData);
        
        // Format data untuk chart
        const labels = revenueData.map(item => item.month);
        const data = revenueData.map(item => item.revenue);

        // Buat chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Pendapatan',
                    data: data,
                    borderColor: '#1cc88a',
                    backgroundColor: '#1cc88a33',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: {
                            color: '#e3e3e3'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
