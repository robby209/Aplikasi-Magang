@extends('dashboard')

@section('title', 'Progress PKL')

@section('content')
<div class="progress-container">
    <h1 class="form-title">Progress PKL</h1>

    <div class="row-box">
        <!-- Riwayat Pendaftaran Section -->
        <div class="box">
            <h2>Riwayat Pendaftaran</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $index => $registration)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($registration->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Penugasan Section -->
        <div class="box">
            <h2>Penugasan</h2>
            @if(isset($assignments) && $assignments->count() > 0)
            <table class="user-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Tugas</th>
                        <th>Deadline</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignments as $index => $assignment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $assignment->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($assignment->deadline)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($assignment->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Tidak ada penugasan saat ini.</p>
            @endif
        </div>
    </div>
</div>
@endsection
