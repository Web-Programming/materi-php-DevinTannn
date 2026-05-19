<a class="navbar-brand" href="{{ url('/') }}">PT.Tandjungan</a>

<button class="navbar-toggler" type="button" 
    data-bs-toggle="collapse" data-bs-target="#mainNavbar" 
    aria-controls="mainNavbar" aria-expanded="false" 
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="mainNavbar">
    <ul class="navbar-nav ms-auto align-items-center">
        {{-- Cek apakah pengguna sudah login --}}
        @auth
        {{-- Menampilkan Info User yang sedang Login --}}
        <li class="nav-item">
            <span class="nav-link text-light me-3">
                Halo, <strong class="text-primary">{{ Auth::user()->name }}</strong>
            </span>
        </li>

        {{-- Tombol Logout menggunakan form POST demi keamanan --}}
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm px-3">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </form>
        </li>
        @else
        {{-- Jika pengguna BELUM login, tampilkan tombol Login & Daftar --}}
        <li class="nav-item">
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2 px-3">Login</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3">Daftar</a>
        </li>
        @endauth
    </ul>
</div>