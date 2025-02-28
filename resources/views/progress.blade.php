@extends('dashboard')

@section('title', 'Progress PKL')

@section('content')
    <div class="progress-container">
        <h1 class="form-title">Progress PKL</h1>
        
        <div class="row-box">
            <!-- Kolom Riwayat Pendaftaran -->
            <div class="box">
                <h2>Riwayat Pendaftaran</h2>
                <p>Di sini Anda dapat menampilkan data pendaftaran PKL yang telah dilakukan. Misalnya, tanggal pendaftaran, status, dan lain-lain.</p>
            </div>

            <!-- Kolom Penugasan -->
            <div class="box">
                <h2>Penugasan</h2>
                <p>Di sini Anda dapat menampilkan detail penugasan atau tugas yang harus diselesaikan selama PKL. Misalnya, tugas harian, laporan, atau milestone tertentu.</p>
            </div>
        </div>
    </div>

    {{-- Anda bisa menempatkan CSS ini di file terpisah atau di dalam <style> di layout --}}
    <style>
        .progress-container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            border: 1px solid #dee2e6;
        }

        .form-title {
            text-align: center;
            margin-bottom: 40px;
            color: #007BFF;
        }

        .row-box {
            display: flex;
            gap: 20px;
        }

        .box {
            flex: 1;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #dee2e6;
        }

        .box h2 {
            margin-bottom: 15px;
            color: #343a40;
        }

        .box p {
            line-height: 1.6;
            color: #555;
        }
    </style>
@endsection
