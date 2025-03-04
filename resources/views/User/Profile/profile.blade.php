@vite(['resources/css/profile.css'])
@extends('dashboard')

@section('title', 'Profil Pengguna')

@section('content')
    <div class="profile-container">
        <!-- Left Sidebar -->
        <div class="profile-sidebar">
            <div class="profile-header">
                <!-- Gunakan foto profil jika tersedia, jika tidak, tampilkan avatar default -->
                <img 
                    src="{{ $user->photo_path 
                            ? asset('storage/' . $user->photo_path) 
                            : asset('storage/profile_images/user.png') 
                         }}" 
                    alt="" 
                    class="profile-img"
                >
                <h2>{{ $user->name }}</h2>
            </div>

            <nav class="profile-nav">
                <ul>
                    <li class="active">
                        <a href="#">
                            <i class="fas fa-user"></i> Profil Saya
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-envelope"></i> Pesan
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Right Content -->
        <div class="profile-content">
            <div class="profile-section">
                <!-- Header bagian INFORMASI PROFIL -->
                <div class="section-header">
                    <h3>INFORMASI PROFIL</h3>
                    <!-- Tombol Edit -->
                    <a href="{{ route('profile.edit') }}" class="btn-edit">Edit</a>
                </div>
                <div class="profile-info">
                    <div class="info-group">
                        <label>Nama</label>
                        <p class="info-value">{{ $user->name }}</p>
                    </div>
                    
                    <div class="info-group">
                        <label>Email</label>
                        <p class="info-value">{{ $user->email }}</p>
                    </div>

                    <div class="info-group">
                        <label>Nomor Telepon</label>
                        <p class="info-value">
                            {{ $user->pklRegistration ? $user->pklRegistration->telepon : ($user->phone ?? 'Belum diisi') }}
                        </p>
                    </div>
                    
                    @if($user->address)
                        <div class="info-group">
                            <label>Alamat</label>
                            <p class="info-value">{{ $user->address }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="profile-section">
                <h3>LAINNYA</h3>
                <div class="info-group">
                    <label>Tanggal Bergabung</label>
                    <p class="info-value">{{ $user->created_at->format('d-m-Y') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
