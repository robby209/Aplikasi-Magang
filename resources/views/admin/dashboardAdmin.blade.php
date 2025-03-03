<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <!-- Font Awesome (opsional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    
    <!-- Memanggil file login.css melalui Vite -->
    @vite(['resources/css/login.css'])
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Welcome Back</h2>
            <p>Please login to continue</p>
        </div>

        @if ($errors->any())
            <div class="error-message" style="display: block;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input 
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                >
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Password" 
                    required
                    minlength="8" 
                    pattern="^(?=.*[A-Za-z])(?=.*\\d).{8,}$"
                    title="Minimum 8 characters with at least 1 letter and 1 number"
                >
            </div>

            <button type="submit" class="login-btn">Sign In</button>
        </form>

        <div class="additional-links">
            <a href="/register">Create new account</a>
        </div>
    </div>
</body>
</html>
