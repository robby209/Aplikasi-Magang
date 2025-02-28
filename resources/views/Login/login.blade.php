<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      background-size: cover;
    }
    .login-container {
      background: rgba(255, 255, 255, 0.95);
      padding: 2.5rem;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      width: 400px;
      transition: all 0.3s ease;
    }
    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }
    .login-header h2 {
      color: #2d3748;
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
    }
    .input-group {
      position: relative;
      margin-bottom: 1.5rem;
    }
    .input-group i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #718096;
    }
    .input-group input {
      width: 100%;
      padding: 12px 20px 12px 40px;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    .input-group input:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      outline: none;
    }
    .login-btn {
      width: 100%;
      padding: 12px;
      background: #667eea;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .login-btn:hover {
      background: #764ba2;
      transform: translateY(-2px);
    }
    .error-message {
      color: #e53e3e;
      background: #fed7d7;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 1rem;
      display: none;
      animation: slideDown 0.3s ease;
    }
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .additional-links {
      margin-top: 1.5rem;
      text-align: center;
    }
    .additional-links a {
      color: #667eea;
      text-decoration: none;
      font-size: 0.9rem;
    }
    .additional-links a:hover {
      text-decoration: underline;
    }
  </style>
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
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required
               minlength="8" pattern="^(?=.*[A-Za-z])(?=.*\d).{8,}$" 
               title="Minimum 8 characters with at least 1 letter and 1 number">
      </div>

      <button type="submit" class="login-btn">Sign In</button>
    </form>

    <div class="additional-links">
      <a href="/register">Create new account</a>
    </div>
  </div>
</body>
</html>
