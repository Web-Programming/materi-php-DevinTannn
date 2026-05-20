<div class="list-group list-group-flush shadow-sm">
    {{-- MENU 1: DASHBOARD --}}
    <a href="{{ url('/dashboard') }}" 
       class="list-group-item list-group-item-action d-flex align-items-center border-bottom {{ request()->is('/') || request()->is('dashboard') ? 'bg-primary text-white fw-bold' : '' }}">
        <i class="bi bi-speedometer2 me-2 fs-5"></i>
        <span>Dashboard</span>
    </a>

    {{-- MENU 2: PRODUK --}}
    <a href="{{ route('produk.index') }}" 
       class="list-group-item list-group-item-action d-flex align-items-center border-bottom {{ request()->is('produk') || request()->is('produk/*') ? 'bg-primary text-white fw-bold' : '' }}">
        <i class="bi bi-box-seam me-2 fs-5"></i>
        <span>Produk</span>
    </a>

    {{-- SUB-MENU PRODUK --}}
    @yield('submenu-produk')

    {{-- MENU 3: SUPPLIER --}}
    <a href="{{ route('supplier.index') }}" 
       class="list-group-item list-group-item-action d-flex align-items-center border-bottom {{ request()->is('supplier') || request()->is('supplier/*') ? 'bg-primary text-white fw-bold' : '' }}">
        <i class="bi bi-truck me-2 fs-5"></i>
        <span>Supplier</span>
    </a>

    {{-- SUB-MENU SUPPLIER --}}
    @yield('submenu-supplier')
</div>