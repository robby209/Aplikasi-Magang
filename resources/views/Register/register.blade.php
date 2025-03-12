<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modern Registration</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  @vite(['resources/css/register.css'])
</head>
<body>
  <div class="register-container">
    <div class="register-header">
      <h2>Create Account</h2>
      <p>Buat akun untuk memulai.</p>
    </div>

    @if ($errors->any())
      <div class="error-message">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form action="/register" method="POST">
      @csrf
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input
          type="text"
          name="name"
          placeholder="Name"
          required
        >
      </div>

      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input
          type="email"
          name="email"
          placeholder="Email"
          required
          pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
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

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input
          type="password"
          name="password_confirmation"
          placeholder="Confirm Password"
          required
        >
      </div>

      <button type="submit" class="register-btn">Create Account</button>
    </form>

    <div class="login-link">
      <span>Already have an account? </span>
      <a href="/login">Login here</a>
    </div>
  </div>
</body>
</html>
