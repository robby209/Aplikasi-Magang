@extends('layout')

@section('title', 'Formulir Pendaftaran PKL')

@section('content')
    <div class="form-page-container">
        <div class="form-container">
            <h1 class="form-title">Formulir Pendaftaran PKL</h1>
            
            @if(session('success'))
                <div class="alert alert-success" id="successMessage">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger custom-alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="penelitianForm" method="POST" action="{{ route('pkl.register') }}" enctype="multipart/form-data">
                @csrf

                <div class="input-group">
                    <label for="name">Nama *</label>
                    <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="input-group">
                    <label for="nim">NIM *</label>
                    <input type="text" name="nim" id="nim" placeholder="Masukkan NIM" required>
                </div>

                <div class="input-group">
                    <label for="alamat">Alamat *</label>
                    <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat" required>
                </div>

                <div class="input-group">
                    <label for="pekerjaan">Pekerjaan / Jabatan *</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Masukkan pekerjaan atau jabatan" required>
                </div>

                <div class="input-group">
                    <label for="fakultas">Fakultas / Program Studi *</label>
                    <input type="text" name="fakultas" id="fakultas" placeholder="Masukkan fakultas atau program studi" required>
                </div>

                <div class="input-group">
                    <label for="instansi">Instansi / Organisasi *</label>
                    <input type="text" name="instansi" id="instansi" placeholder="Masukkan instansi atau organisasi" required>
                </div>

                <div class="input-group">
                    <label for="telepon">Nomor Telepon / HP *</label>
                    <input type="text" name="telepon" id="telepon" placeholder="Masukkan nomor telepon atau HP" required>
                </div>

                <div class="input-group">
                    <label for="proposal">Proposal Penelitian (PDF) *</label>
                    <div class="file-upload">
                        <i class="fas fa-cloud-upload-alt fa-2x"></i>
                        <p>Seret file atau klik untuk mengunggah</p>
                        <input type="file" name="proposal" id="proposal" accept="application/pdf" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="judul">Judul Penelitian *</label>
                    <input type="text" name="judul" id="judul" placeholder="Masukkan judul penelitian" required>
                </div>

                <div class="input-group">
                    <label for="tujuan">Tujuan Penelitian *</label>
                    <textarea name="tujuan" id="tujuan" placeholder="Masukkan tujuan penelitian" required></textarea>
                </div>

                <div class="input-group">
                    <label for="anggota">Anggota / Peserta *</label>
                    <input type="text" name="anggota" id="anggota" placeholder="Masukkan anggota atau peserta" required>
                </div>

                <div class="date-row">
                    <div class="input-group">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" required>
                    </div>
                    <div class="input-group">
                        <label for="end_date">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" required>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Daftar Sekarang</button>
            </form>
        </div>
    </div>
@endsection

@section('styles')
<style>
    /* Latar belakang gradien, mirip login style */
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        background-size: cover;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-page-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.95);
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        width: 500px;
        margin: 2rem auto;
        transition: all 0.3s ease;
    }

    .form-title {
        text-align: center;
        color: #2d3748;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 1rem;
        text-align: center;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        opacity: 1;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .custom-alert ul {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .custom-alert li::before {
        content: "• ";
        color: #721c24;
    }

    .input-group {
        margin-bottom: 1rem;
        position: relative;
    }

    .input-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #2d3748;
    }

    .input-group input,
    .input-group textarea {
        width: 100%;
        padding: 12px 14px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .input-group input:focus,
    .input-group textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .file-upload {
        border: 2px dashed #e2e8f0;
        border-radius: 8px;
        padding: 25px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: #ffffff;
    }

    .file-upload:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .date-row {
        display: flex;
        gap: 1rem;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background: #667eea;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1.5rem;
    }

    .submit-btn:hover {
        background: #764ba2;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('scripts')
<script>
    const fileUpload = document.querySelector('.file-upload');
    const fileInput = document.getElementById('proposal');

    fileUpload.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function() {
        if(this.files.length > 0) {
            fileUpload.innerHTML = `
                <i class="fas fa-check-circle fa-2x" style="color: #4CAF50;"></i>
                <p>${this.files[0].name}</p>
            `;
        }
    });

    // Handle success message display and disappearance
    const successMessage = document.getElementById('successMessage');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.opacity = 0;
            setTimeout(() => {
                successMessage.remove();
            }, 500);
        }, 5000);
    }
</script>
@endsection
