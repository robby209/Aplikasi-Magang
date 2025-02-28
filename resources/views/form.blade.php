@extends('dashboard')

@section('title', 'Formulir Pendaftaran PKL')

@section('content')
<div class="form-container">
    <h1 class="form-title">Formulir Pendaftaran PKL</h1>

    <!-- Contoh Notifikasi Session -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="list-style:none;margin:0;padding:0;">
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pkl.register') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="input-group">
            <label for="name">Nama *</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="input-group">
            <label for="nim">NIM *</label>
            <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>
        </div>

        <div class="input-group">
            <label for="alamat">Alamat *</label>
            <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat" required>
        </div>

        <div class="input-group">
            <label for="pekerjaan">Pekerjaan / Jabatan *</label>
            <input type="text" id="pekerjaan" name="pekerjaan" placeholder="Masukkan pekerjaan atau jabatan" required>
        </div>

        <div class="input-group">
            <label for="fakultas">Fakultas / Program Studi *</label>
            <input type="text" id="fakultas" name="fakultas" placeholder="Masukkan fakultas atau program studi" required>
        </div>

        <div class="input-group">
            <label for="instansi">Instansi / Organisasi *</label>
            <input type="text" id="instansi" name="instansi" placeholder="Masukkan instansi atau organisasi" required>
        </div>

        <div class="input-group">
            <label for="telepon">Nomor Telepon / HP *</label>
            <input type="text" id="telepon" name="telepon" placeholder="Masukkan nomor telepon atau HP" required>
        </div>

        <div class="input-group">
            <label for="proposal">Proposal Penelitian (PDF) *</label>
            <input type="file" id="proposal" name="proposal" accept="application/pdf" required>
        </div>

        <div class="input-group">
            <label for="judul">Judul Penelitian *</label>
            <input type="text" id="judul" name="judul" placeholder="Masukkan judul penelitian" required>
        </div>

        <div class="input-group">
            <label for="tujuan">Tujuan Penelitian *</label>
            <textarea id="tujuan" name="tujuan" placeholder="Masukkan tujuan penelitian" required></textarea>
        </div>

        <div class="input-group">
            <label for="anggota">Anggota / Peserta *</label>
            <input type="text" id="anggota" name="anggota" placeholder="Masukkan anggota atau peserta" required>
        </div>

        <div class="date-row">
            <div class="input-group">
                <label for="start_date">Tanggal Mulai *</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="input-group">
                <label for="end_date">Tanggal Selesai *</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
        </div>

        <button type="submit" class="submit-btn">Daftar Sekarang</button>
    </form>
</div>
@endsection
