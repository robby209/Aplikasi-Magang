<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Meta untuk viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta tag keamanan -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com;">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <!-- CSRF Token (jika diperlukan oleh script JavaScript) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Dashboard')</title>
    
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
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

        /* Sidebar Enhanced */
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
            position: relative;
            overflow: hidden;
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

        /* Main Content */
        .content {
            margin-left: 280px;
            padding: 40px;
            flex-grow: 1;
            transition: all 0.3s;
            background: var(--light-bg);
        }

        /* Form Styling */
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            border: 1px solid #dee2e6;
        }

        .form-title {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 40px;
            font-size: 2.2rem;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-text);
        }

        .input-group input {
            width: 100%;
            padding: 14px;
            border: 2px solid #ced4da;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #ffffff;
            color: var(--dark-text);
        }

        .input-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
            outline: none;
        }

        .date-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .file-upload {
            border: 2px dashed #ced4da;
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #ffffff;
        }

        .file-upload:hover {
            border-color: var(--primary-color);
            background: rgba(0, 123, 255, 0.05);
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--primary-color), #0056b3);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: block;
            margin: 30px auto 0;
            width: fit-content;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        /* Button Styling */
        .action-btn {
            background: linear-gradient(135deg, var(--primary-color), #0056b3);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin: 10px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        /* Alert */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            font-weight: 500;
            z-index: 1000;
        }

        .alert.success {
            background: #4CAF50;
            color: white;
        }

        .alert.error {
            background: #f44336;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 280px;
            }
            .content {
                margin-left: 280px;
            }
        }

        @media (max-width: 768px) {
            .date-row {
                grid-template-columns: 1fr;
            }
            .content {
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <span class="brand-text">Dashboard</span>
        </div>
        <a href="{{ route('form') }}" class="nav-item {{ request()->routeIs('form') ? 'active' : '' }}">
            <i class="fas fa-file-alt nav-icon"></i>
            <span class="nav-text">Formulir PKL</span>
        </a>
        <a href="{{ route('progress') }}" class="nav-item {{ request()->routeIs('progress') ? 'active' : '' }}">
            <i class="fas fa-tasks nav-icon"></i>
            <span class="nav-text">Progress</span>
        </a>
        <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="fas fa-user-graduate nav-icon"></i>
            <span class="nav-text">Profil</span>
        </a>
        <a href="{{ route('login') }}" class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <span class="nav-text">Logout</span>
        </a>
    </div>

    <div class="content" id="mainContent">
        @yield('content')
    </div>

    <script>
        // File Upload Interaction
        const fileUpload = document.getElementById('fileUpload');
        const fileInput = document.getElementById('surat');
        
        if(fileUpload && fileInput) {
            fileUpload.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', function() {
                if(this.files.length > 0) {
                    fileUpload.innerHTML = `
                        <i class="fas fa-check-circle fa-2x" style="color: #4CAF50;"></i>
                        <p>${this.files[0].name}</p>
                    `;
                }
            });
        }

        // Form Validation
        const pklForm = document.getElementById('pklForm');
        if(pklForm) {
            pklForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const startDate = new Date(document.getElementById('startDate').value);
                const endDate = new Date(document.getElementById('endDate').value);
                
                if(endDate <= startDate) {
                    showAlert('error', 'Tanggal selesai harus setelah tanggal mulai!');
                    return;
                }
                
                showAlert('success', 'Pendaftaran berhasil dikirim!');
                this.reset();
                fileUpload.innerHTML = `
                    <i class="fas fa-cloud-upload-alt fa-2x"></i>
                    <p>Seret file atau klik untuk mengunggah</p>
                `;
            });
        }

        function showAlert(type, message) {
            const alert = document.createElement('div');
            alert.className = `alert ${type}`;
            alert.textContent = message;
            document.body.appendChild(alert);
            
            setTimeout(() => alert.remove(), 3000);
        }

        // Navigation Active State
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
                window.location.href = this.href;
            });
        });
    </script>
</body>
</html>
