<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard')</title>
    
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    @vite(['resources/css/admin.css'])
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <span class="brand-text">Admin Dashboard</span>
        </div>

        <a href="{{ route('admin') }}" 
           class="nav-item {{ request()->routeIs('admin') ? 'active' : '' }}">
            <i class="fas fa-file-alt nav-icon"></i>
            <span class="nav-text">Verifikasi & Persetujuan</span>
        </a>

        <a href="{{ route('daftar-peserta') }}" 
           class="nav-item {{ request()->routeIs('progress') ? 'active' : '' }}">
            <i class="fas fa-tasks nav-icon"></i>
            <span class="nav-text">Daftar Peserta</span>
        </a>

        <a href="#" class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <span class="nav-text">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
