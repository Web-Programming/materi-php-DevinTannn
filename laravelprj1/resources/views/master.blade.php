<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - My Laravel App</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { display: flex; min-height: 100vh; overflow-x: hidden; }
        #sidebar { width: 250px; background: #343a40; color: white; transition: all 0.3s; }
        #content { flex: 1; padding: 20px; background: #f8f9fa; }
        .nav-link { color: rgba(255,255,255,.8); }
        .nav-link:hover, .nav-link.active { color: white; background: #495057; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="d-flex flex-column p-3">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Laravel Project</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('produk.index') }}" class="nav-link {{ request()->is('produk*') ? 'active' : '' }}">
                    <i class="fas fa-box me-2"></i> Produk
                </a>
                <!-- Tempat Submenu Muncul -->
                <div class="list-group list-group-flush small">
                    @yield('submenu-produk')
                </div>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->is('supplier*') ? 'active' : '' }}">
                    <i class="fas fa-truck me-2"></i> Supplier
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
            <div class="container-fluid">
                <span class="navbar-brand">Devin Tan Dashboard</span>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>