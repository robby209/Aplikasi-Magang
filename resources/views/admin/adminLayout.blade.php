<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        :root {
            --primary-color: #007BFF;
            --secondary-color: #f8f9fa;
            --accent-color: #FF7F50;
            --light-bg: #ffffff;
            --dark-text: #343a40;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light-bg);
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            color: var(--dark-text);
        }
        .sidebar {
            width: 280px;
            background: var(--primary-color);
            color: white;
            padding: 25px;
            position: fixed;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            border-right: 1px solid #0056b3;
        }
        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            padding: 0 10px;
        }
        .brand-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff;
        }
        .nav-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            margin: 8px 0;
            border-radius: 10px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.05);
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .nav-item.active {
            background: var(--accent-color);
            box-shadow: 0 4px 15px rgba(255,127,80,0.3);
        }
        .nav-icon {
            font-size: 1.2rem;
            min-width: 30px;
            transition: all 0.3s;
        }
        .nav-text {
            margin-left: 15px;
            white-space: nowrap;
            transition: all 0.3s;
        }
        .content {
            margin-left: 280px;
            padding: 40px;
            flex-grow: 1;
            background: var(--light-bg);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <span class="brand-text">Admin Dashboard</span>
        </div>
        <a href="{{ route('admin') }}" class="nav-item {{ request()->routeIs('admin') ? 'active' : '' }}">
            <i class="fas fa-file-alt nav-icon"></i>
            <span class="nav-text">Verifikasi & Persetujuan</span>
        </a>
        <a href="{{ route('daftar-peserta') }}" class="nav-item {{ request()->routeIs('progress') ? 'active' : '' }}">
            <i class="fas fa-tasks nav-icon"></i>
            <span class="nav-text">Daftar Peserta</span>
        </a>
        <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="fas fa-user-graduate nav-icon"></i>
            <span class="nav-text">Profil</span>
        </a>
        <a href="{{ route('logout') }}" class="nav-item">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <span class="nav-text">Logout</span>
        </a>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
