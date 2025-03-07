<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Meta viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Keamanan -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Atur cache agar tidak tersimpan -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <title>@yield('title', 'Dashboard')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Memanggil CSS via Vite -->
    @vite(['resources/css/user.css', 'resources/js/app.js'])
</head>
<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <span class="brand-text">Dashboard</span>
        </div>
        <a href="{{ route('form') }}" class="nav-item {{ request()->routeIs('form') ? 'active' : '' }}">
            <i class="fas fa-file-alt nav-icon"></i>
            <span class="nav-text">Formulir PKL</span>
        </a>
        <a href="{{ route('progress') }}" class="nav-item {{ request()->routeIs('progress') ? 'active' : '' }}">
            <i class="fas fa-tasks nav-icon"></i>
            <span class="nav-text">Riwayat Pendaftaran</span>
        </a>
        <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="fas fa-user-graduate nav-icon"></i>
            <span class="nav-text">Profil</span>
        </a>
        <!-- Tombol Logout menggunakan form POST -->
        <a href="#" class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <span class="nav-text">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <script>
        // Mengaktifkan link sidebar
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                // Abaikan event jika logout (karena ditangani form)
                if(this.getAttribute('href') === '#') return;
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
                window.location.href = this.href;
            });
        });
    </script>
</body>
</html>
