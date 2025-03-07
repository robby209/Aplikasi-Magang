@extends('dashboard')

@section('title', 'Riwayat Permohonan')

@section('content')
<div class="progress-section">
    <!-- Card utama -->
    <div class="progress-card">
        <!-- Header card dengan gradasi atau warna utama -->
        <div class="progress-header">
            <h2 class="progress-title">Riwayat Permohonan</h2>
        </div>

        <!-- Isi card -->
        <div class="progress-body">
            <table class="progress-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Status</th>
                        <th>Keterangan Permohonan</th>
                        <th>Tanggal dan Jam</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatPermohonan as $index => $record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($record['status'] == 'accepted')
                                <span class="status-accepted">Diterima</span>
                            @elseif($record['status'] == 'rejected')
                                <span class="status-rejected">Ditolak</span>
                            @elseif($record['status'] == 'pending')
                                <span class="status-pending">Menunggu</span>
                            @else
                                {{ ucfirst($record['status']) }}
                            @endif
                        </td>
                        <td>{{ $record['keterangan_status'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($record['created_at'])->format('d F Y H:i:s') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="empty-row">
                            Tidak ada riwayat permohonan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
