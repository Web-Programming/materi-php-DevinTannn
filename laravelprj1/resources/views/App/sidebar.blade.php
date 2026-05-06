<div class="list-group list-group-flush">
    <a href="{{ url('/') }}" class="list-group-item list-group-item-action {{ request()->path() === '/' ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('produk.index') }}" class="list-group-item list-group-item-action {{ request()->is('produk') || request()->is('produk/*') ? 'active' : '' }}">
        Produk
    </a>

    @yield('submenu-produk')

    <a href="{{ route('supplier.index') }}" class="list-group-item list-group-item-action {{ request()->is('supplier') || request()->is('supplier/*') ? 'active' : '' }}">
        Supplier
    </a>

    @yield('submenu-supplier')
</div>