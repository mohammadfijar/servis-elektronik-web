@extends('layouts.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
</div>
<div class="row">
  @component('components.dashboard-card',[
    'title'=>'Pending Service',
    'count'=>$pendingServices,
    'icon'=>'fas fa-clock',
    'color'=>'warning',
    'url'=>route('services.index', ['status' => 'pending']) // Sesuaikan dengan route Anda
  ])@endcomponent
  
  @component('components.dashboard-card',[
    'title'=>'In Progress',
    'count'=>$inProgress,
    'icon'=>'fas fa-spinner',
    'color'=>'primary',
    'url'=>route('services.index', ['status' => 'in_progress'])
  ])@endcomponent
  
  @component('components.dashboard-card',[
    'title'=>'Completed',
    'count'=>$completed,
    'icon'=>'fas fa-check-circle',
    'color'=>'success',
    'url'=>route('services.index', ['status' => 'completed'])
  ])@endcomponent
  
@component('components.dashboard-card',[
  'title'=>'Total Item',
  'count'=>$totalItems,
  'icon'=>'fas fa-boxes',
  'color'=>'info',
  'url'=>route('items.index')
])@endcomponent
</div>
@endsection