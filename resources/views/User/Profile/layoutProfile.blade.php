<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<style>
    .profile-container {
        display: flex;
        max-width: 1200px;
        margin: 2rem auto;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .profile-sidebar {
        width: 300px;
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 15px 0 0 15px;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .profile-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-bottom: 1rem;
        border: 4px solid #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .profile-nav ul {
        list-style: none;
        padding: 0;
    }

    .profile-nav li a {
        display: flex;
        align-items: center;
        padding: 12px;
        margin: 8px 0;
        color: #666;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .profile-nav li a:hover {
        background: #e9ecef;
    }

    .profile-nav li a i {
        margin-right: 10px;
        width: 20px;
    }

    .profile-nav .active a {
        background: #007bff;
        color: white;
    }

    .profile-content {
        flex: 1;
        padding: 2rem;
    }

    .profile-section {
        margin-bottom: 2rem;
    }

    .profile-section h3 {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
    }

    .info-group {
        margin-bottom: 1.5rem;
    }

    .info-group label {
        display: block;
        color: #999;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .info-value {
        font-size: 1rem;
        color: #333;
        padding: 0.5rem 0;
        border-bottom: 2px solid #f0f0f0;
    }

    .help-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #eee;
    }

    .help-section a {
        color: #666;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .help-section a i {
        margin-right: 8px;
    }
</style>
</html>
