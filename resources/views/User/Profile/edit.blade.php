@vite(['resources/css/profile.css'])
@extends('dashboard')

@section('title', 'Edit Profil')

@section('content')
<div class="profile-container">
    <div class="profile-content">
        <h3>Edit Profil</h3>
        
        <!-- Tampilkan pesan sukses/error jika ada -->
        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        
        @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <!-- Nama -->
            <div class="info-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
            </div>

            <!-- Email -->
            <div class="info-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
            </div>

            <!-- Tambahkan field lain jika diperlukan -->

            <button type="submit" class="btn-edit">Simpan</button>
        </form>
    </div>
</div>
@endsection
