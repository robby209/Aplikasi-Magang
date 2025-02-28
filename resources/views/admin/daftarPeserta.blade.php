@extends('admin.adminLayout')

@section('title', 'Daftar Peserta PKL')

@section('content')
<div class="admin-container">
    <h1 class="form-title">Daftar Peserta PKL</h1>
    <table class="admin-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Judul Penelitian</th>
                <th>Tanggal</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($participants as $index => $participant)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $participant->nama }}</td>
                    <td>{{ $participant->judul }}</td>
                    <td>{{ $participant->start_date }} - {{ $participant->end_date }}</td>
                    <td>
                        <button 
                            class="action-btn detail-btn" 
                            data-id="{{ $participant->id }}"
                            data-nama="{{ $participant->nama }}"
                            data-judul="{{ $participant->judul }}"
                            data-start_date="{{ $participant->start_date }}"
                            data-end_date="{{ $participant->end_date }}"
                            data-instansi="{{ $participant->instansi }}"
                            data-alamat="{{ $participant->alamat }}"
                            data-tujuan="{{ $participant->tujuan }}"
                            data-telepon="{{ $participant->telepon }}"
                        >
                            Detail
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada peserta yang diterima.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Overlay untuk Detail Peserta -->
<div id="detailModal" class="modal-overlay">
    <div class="modal-content">
        <h2>Detail Peserta</h2>
        <p><strong>Nama:</strong> <span id="modalNama"></span></p>
        <p><strong>Judul Penelitian:</strong> <span id="modalJudul"></span></p>
        <p><strong>Tanggal:</strong> <span id="modalTanggal"></span></p>
        <p><strong>Instansi:</strong> <span id="modalInstansi"></span></p>
        <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
        <p><strong>Tujuan Penelitian:</strong> <span id="modalTujuan"></span></p>
        <p><strong>Nomor Telepon:</strong> <span id="modalTelepon"></span></p>
        <div class="modal-actions">
            <button class="close-btn" id="closeModal">Tutup</button>
        </div>
    </div>
</div>

<style>
    .admin-container {
        max-width: 1200px;
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
    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }
    .admin-table th,
    .admin-table td {
        padding: 15px;
        border: 1px solid #dee2e6;
        text-align: center;
    }
    .admin-table thead {
        background: var(--primary-color);
        color: #fff;
    }
    .admin-table tbody tr:nth-child(even) {
        background: #f8f9fa;
    }
    .action-btn {
        background: linear-gradient(135deg, var(--primary-color), #0056b3);
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
    .modal-content {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        width: 500px;
        max-width: 90%;
    }
    .modal-actions {
        margin-top: 20px;
        text-align: right;
    }
    .close-btn {
        background: #6c757d;
        color: #fff;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .close-btn:hover {
        background: #5a6268;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const detailButtons = document.querySelectorAll('.detail-btn');
    const detailModal = document.getElementById('detailModal');
    const closeModalBtn = document.getElementById('closeModal');

    detailButtons.forEach(button => {
        button.addEventListener('click', function() {
            const nama = this.getAttribute('data-nama');
            const judul = this.getAttribute('data-judul');
            const startDate = this.getAttribute('data-start_date');
            const endDate = this.getAttribute('data-end_date');
            const instansi = this.getAttribute('data-instansi');
            const alamat = this.getAttribute('data-alamat');
            const tujuan = this.getAttribute('data-tujuan');
            const telepon = this.getAttribute('data-telepon');

            document.getElementById('modalNama').textContent = nama;
            document.getElementById('modalJudul').textContent = judul;
            document.getElementById('modalTanggal').textContent = startDate + ' - ' + endDate;
            document.getElementById('modalInstansi').textContent = instansi;
            document.getElementById('modalAlamat').textContent = alamat;
            document.getElementById('modalTujuan').textContent = tujuan;
            document.getElementById('modalTelepon').textContent = telepon;

            detailModal.style.display = 'flex';
        });
    });

    closeModalBtn.addEventListener('click', function() {
        detailModal.style.display = 'none';
    });
});
</script>
@endsection
