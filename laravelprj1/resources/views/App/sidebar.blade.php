<div class="list-group list-group-flush">
    {{-- MENU 1: DASHBOARD --}}
    {{-- FIX: Mengecek apakah path saat ini adalah '/' ATAU 'dashboard' agar tombol otomatis berwarna biru aktif --}}
    <a href="{{ url('/dashboard') }}" 
       class="list-group-item list-group-item-action d-flex align-items-center {{ request()->is('/') || request()->is('dashboard') ? 'active text-white bg-primary' : '' }}">
        <i class="bi bi-speedometer2 me-2 fs-5"></i>
        <span>Dashboard</span>
    </a>

    {{-- MENU 2: PRODUK --}}
    <a href="{{ route('produk.index') }}" 
       class="list-group-item list-group-item-action d-flex align-items-center {{ request()->is('produk') || request()->is('produk/*') ? 'active text-white bg-primary' : '' }}">
        <i class="bi bi-box-seam me-2 fs-5"></i>
        <span>Produk</span>
    </a>

    @yield('submenu-produk')

    {{-- MENU 3: SUPPLIER --}}
    <a href="{{ route('supplier.index') }}" 
       class="list-group-item list-group-item-action d-flex align-items-center {{ request()->is('supplier') || request()->is('supplier/*') ? 'active text-white bg-primary' : '' }}">
        <i class="bi bi-truck me-2 fs-5"></i>
        <span>Supplier</span>
    </a>

    @yield('submenu-supplier')
</div>