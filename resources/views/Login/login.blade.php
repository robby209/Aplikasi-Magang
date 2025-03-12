<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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

    <form action="/login" method="POST" id="loginForm">
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
          pattern="^(?=.*[A-Za-z])(?=.*\d).{8,}$"  
          title="Katasandi Harus minimal 8 karakter dan mengandung setidaknya 1 huruf dan 1 angka"
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
