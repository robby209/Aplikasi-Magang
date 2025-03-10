@vite(['resources/css/profile.css'])
@extends('dashboard')

@section('title', 'Profil Pengguna')

@section('content')
    <div class="profile-container">
        <!-- Left Sidebar -->
        <div class="profile-sidebar">
            <div class="profile-header">
                <img 
                    src="{{ $user->photo_path 
                            ? asset('storage/' . $user->photo_path) 
                            : asset('storage/profile_images/user.png') 
                         }}" 
                    alt="Foto Profil {{ e($user->name) }}" 
                    class="profile-img"
                >
                <h2>{{ e($user->name) }}</h2>
            </div>

            <nav class="profile-nav">
                <ul>
                    <li class="active">
                        <a href="#">
                            <i class="fas fa-user"></i> Profil Saya
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Right Content -->
        <div class="profile-content">
            <div class="profile-section">
                <div class="section-header">
                    <h3>INFORMASI PROFIL</h3>
                </div>

                <div class="profile-info">
                    <div class="info-group">
                        <label>Nama</label>
                        <p class="info-value">{{ e($user->name) }}</p>
                    </div>
                    
                    <div class="info-group">
                        <label>Email</label>
                        <p class="info-value">{{ e($user->email) }}</p>
                    </div>

                    <div class="info-group">
                        <label>Nomor Telepon</label>
                        <p class="info-value">
                            {{ $user->pklRegistration->telepon ?? 'Belum diisi' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="profile-section">
                <h3>LAINNYA</h3>
                <div class="info-group">
                    <label>Tanggal Bergabung</label>
                    <p class="info-value">{{ $user->created_at->format('d-m-Y') }}</p>
                </div>
            </div>

            <!-- FORM EDIT PROFIL -->
            <div class="profile-section">
                <h3>Edit Profil</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="info-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" 
                               value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="info-group">
                        <label for="telepon">Nomor Telepon</label>
                        <input type="text" name="telepon" id="telepon" 
                               value="{{ old('telepon', $user->pklRegistration->telepon ?? '') }}">
                    </div>

                    <div class="info-group">
                        <label for="photo">Foto Profil</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                        @if($user->photo_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $user->photo_path) }}" 
                                     alt="Current Photo" 
                                     style="max-width: 100px;">
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn-edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection