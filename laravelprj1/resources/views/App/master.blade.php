<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Font Awesome untuk Ikon Sidebar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap Icons untuk Ikon Search di Navbar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    
    <!-- NAVBAR UTAMA -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <!-- Brand / Logo Utama -->
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">PT.Tandjungan</a>

            <!-- Tombol Toggler untuk HP / Mobile -->
            <button class="navbar-toggler" type="button" 
                data-bs-toggle="collapse" data-bs-target="#mainNavbar" 
                aria-controls="mainNavbar" aria-expanded="false" 
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Wadah Pembungkus Flexbox Navbar -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                {{-- Memanggil file blade navbar yang berisi susunan Kiri, Tengah, Kanan --}}
                @include('app.navbar')
            </div>
        </div>
    </nav>

    <!-- LAYOUT UTAMA (Sidebar & Konten) -->
    <div class="container-fluid">
        <div class="row">
            <!-- Bagian Kiri: Sidebar -->
            <aside class="col-md-3 col-lg-2 bg-light border-end min-vh-100 p-3">
                @section('sidebar')
                    @include('app.sidebar')
                @show
            </aside>

            <!-- Bagian Kanan: Konten Utama Halaman -->
            <main class="col-md-9 col-lg-10 p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5.3.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>