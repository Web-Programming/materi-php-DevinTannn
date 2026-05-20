@auth
{{-- Membagi posisi menjadi Kiri, Tengah, dan Kanan secara otomatis --}}
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center w-100">
    
    {{-- ==================== [1] BAGIAN KIRI: MENU NAVIGASI ==================== --}}
    <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item mx-2">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'text-white active fw-bold' : 'text-white-50' }}" 
               href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link {{ request()->routeIs('produk*') ? 'text-white active fw-bold' : 'text-white-50' }}" 
               href="{{ route('produk.index') }}">Produk</a>
        </li>
        <li class="nav-item mx-2">
            <a class="nav-link {{ request()->routeIs('supplier*') ? 'text-white active fw-bold' : 'text-white-50' }}" 
               href="{{ route('supplier.index') }}">Supplier</a>
        </li>
    </ul>

    {{-- ==================== [2] BAGIAN TENGAH: FORM SEARCH DENGAN TOMBOL PILIHAN ==================== --}}
    <div class="mx-lg-auto my-2 my-lg-0 w-100" style="max-width: 480px;">
        {{-- Javascript Dinamis: Mengubah action form secara otomatis tergantung tombol yang dipilih --}}
        <form id="navbarSearchForm" action="{{ request()->routeIs('supplier*') ? route('supplier.search') : route('produk.search') }}" method="GET">
            <div class="input-group input-group-sm">
                
                <!-- Tombol Pilihan Jenis Data (Dropdown di dalam Input Group) -->
                <button class="btn btn-warning dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="searchTypeBtn">
                    @if(request()->routeIs('supplier*'))
                        <i class="fas fa-truck me-1"></i> Supplier
                    @else
                        <i class="fas fa-box me-1"></i> Produk
                    @endif
                </button>
                
                <!-- Menu Pilihan Dropdown -->
                <ul class="dropdown-menu shadow">
                    <li>
                        <button class="dropdown-item" type="button" onclick="switchSearchType('produk', '{{ route('produk.search') }}')">
                            <i class="fas fa-box me-2 text-primary"></i> Cari Produk
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item" type="button" onclick="switchSearchType('supplier', '{{ route('supplier.search') }}')">
                            <i class="fas fa-truck me-2 text-success"></i> Cari Supplier
                        </button>
                    </li>
                </ul>

                <!-- Input Text Kata Kunci -->
                <input type="text" name="keyword" id="navbarSearchInput" class="form-control" 
                       placeholder="{{ request()->routeIs('supplier*') ? 'Masukkan nama supplier...' : 'Masukkan nama produk...' }}" 
                       value="{{ request('keyword') }}" aria-label="Search">
                
                <!-- Tombol Submit Cari -->
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
    </div>

    {{-- ==================== [3] BAGIAN KANAN: HALO USER & LOGOUT ==================== --}}
    <ul class="navbar-nav align-items-center flex-row justify-content-end mt-2 mt-lg-0">
        <li class="nav-item me-3">
            <span class="nav-link text-light">
                Halo, <strong class="text-primary">{{ Auth::user()->name }}</strong>
            </span>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm px-3">
                    Logout
                </button>
            </form>
        </li>
    </ul>

</div>

{{-- Script Javascript Mini untuk Mengubah Mode Pencarian Tanpa Reload --}}
<script>
    function switchSearchType(type, routeUrl) {
        const form = document.getElementById('navbarSearchForm');
        const button = document.getElementById('searchTypeBtn');
        const input = document.getElementById('navbarSearchInput');
        
        // Ubah tujuan rute action form
        form.action = routeUrl;
        
        // Ubah tampilan teks & ikon tombol dropdown sesuai pilihan
        if (type === 'produk') {
            button.innerHTML = '<i class="fas fa-box me-1"></i> Produk';
            input.placeholder = 'Masukkan nama produk...';
        } else {
            button.innerHTML = '<i class="fas fa-truck me-1"></i> Supplier';
            input.placeholder = 'Masukkan nama supplier...';
        }
        
        // Fokuskan kursor kembali ke kotak input setelah memilih
        input.focus();
    }
</script>

@else
{{-- ==================== MENU JIKA BELUM LOGIN ==================== --}}
<ul class="navbar-nav ms-auto align-items-center mt-2 mt-lg-0 flex-row">
    <li class="nav-item">
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2 px-3">Login</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3">Daftar</a>
    </li>
</ul>
@endauth