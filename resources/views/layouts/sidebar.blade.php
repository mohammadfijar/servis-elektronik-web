<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" 
     href="{{ auth()->user()->hasRole('owner') ? route('dashboard.owner') : ( auth()->user()->hasRole('admin') ? route('dashboard.admin') : ( auth()->user()->hasRole('staff') ? route('dashboard.staff') : route('dashboard') ) ) }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-cash-register"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Epson POS</div>
  </a>

  <hr class="sidebar-divider my-0">

  {{-- Dashboard --}}
  <li class="nav-item active">
    @if (auth()->user()->hasRole('owner'))
      <a class="nav-link" href="{{ route('dashboard.owner') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard Owner</span>
      </a>
    @elseif (auth()->user()->hasRole('admin'))
      <a class="nav-link" href="{{ route('dashboard.admin') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard Admin</span>
      </a>
    @elseif (auth()->user()->hasRole('staff'))
      <a class="nav-link" href="{{ route('dashboard.staff') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard Staff</span>
      </a>
    @else
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
      </a>
    @endif
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">Master Data</div>

  {{-- admin, owner & staff --}}
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('staff'))
<li class="nav-item {{ request()->routeIs('penjualan.*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('penjualan.index') }}">
    <i class="fas fa-fw fa-shopping-cart"></i><span>Penjualans</span>
  </a>
</li>
@endif


  {{-- Semua role lihat Customers --}}
  <li class="nav-item {{ request()->routeIs('customers.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('customers.index') }}">
      <i class="fas fa-fw fa-users"></i><span>Customers</span>
    </a>
  </li>

  {{-- admin & owner --}}
  @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner'))
  <li class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('categories.index') }}">
      <i class="fas fa-fw fa-tags"></i><span>Categories</span>
    </a>
  </li>
  <li class="nav-item {{ request()->routeIs('items.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('items.index') }}">
      <i class="fas fa-fw fa-box-open"></i><span>Items</span>
    </a>
  </li>
  @endif

  {{-- admin, owner & staff --}}
  @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('staff'))
  <li class="nav-item {{ request()->routeIs('services.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('services.index') }}">
      <i class="fas fa-fw fa-concierge-bell"></i><span>Services</span>
    </a>
  </li>
  @endif

  {{-- admin & owner --}}
  @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner'))
  <li class="nav-item {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('suppliers.index') }}">
      <i class="fas fa-fw fa-truck"></i><span>Suppliers</span>
    </a>
  </li>
  @endif

  {{-- semua kecuali user biasa --}}
  @if(! auth()->user()->hasRole('user'))
  <li class="nav-item {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('transactions.index') }}">
      <i class="fas fa-fw fa-receipt"></i><span>Transactions</span>
    </a>
  </li>
  @endif

  {{-- hanya Owner --}}
  @if(auth()->user()->hasRole('owner'))
  <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
      <i class="fas fa-fw fa-user-cog"></i><span>User Management</span>
    </a>
  </li>
  @endif

  @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner'))

  <hr class="sidebar-divider">
  <div class="sidebar-heading">Reports</div>

  {{-- semua role boleh export trx & services --}}
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('transactions.export') }}">
      <i class="fas fa-fw fa-file-export"></i><span>Export Transactions</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('services.export') }}">
      <i class="fas fa-fw fa-file-export"></i><span>Export Services</span>
    </a>
  </li>

  {{-- hanya admin & owner --}}
  <li class="nav-item">
    <a class="nav-link" href="{{ route('suppliers.export') }}">
      <i class="fas fa-fw fa-file-export"></i><span>Export Suppliers</span>
    </a>
  </li>
  @endif

  <hr class="sidebar-divider d-none d-md-block">
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
