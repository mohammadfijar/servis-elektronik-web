<div class="col-xl-3 col-md-6 mb-4">
  <a href="{{ $url }}" class="text-decoration-none"> {{-- Tambahkan tag anchor --}}
    <div class="card border-left-{{ $color }} shadow h-100 py-3 hover:shadow-lg transition-shadow">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-lg font-weight-bold text-{{ $color }} text-uppercase mb-2">
              {{ $title }}
            </div>
            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $count }}</div>
          </div>
          <div class="col-auto">
            <i class="{{ $icon }} fa-3x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </a> {{-- Tutup tag anchor --}}
</div>