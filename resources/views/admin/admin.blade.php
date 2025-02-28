@extends('admin.adminLayout')

@section('title', 'Daftar Pendaftar PKL')

@section('content')
    <div class="admin-container">
        <h1 class="form-title">Daftar Pendaftar PKL</h1>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Judul Penelitian</th>
                    <th>Nomor Telepon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pklRegistrations as $index => $registration)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $registration->nama }}</td>
                        <td>{{ $registration->fakultas }}</td>
                        <td>{{ $registration->judul }}</td>
                        <td>{{ $registration->telepon }}</td>
                        <td>
                            <button 
                                class="action-btn detail-btn"
                                data-id="{{ $registration->id }}"
                                data-nama="{{ $registration->nama }}"
                                data-fakultas="{{ $registration->fakultas }}"
                                data-judul="{{ $registration->judul }}"
                                data-telepon="{{ $registration->telepon }}"
                                data-instansi="{{ $registration->instansi }}"
                                data-alamat="{{ $registration->alamat }}"
                                data-tujuan="{{ $registration->tujuan }}"
                                data-start_date="{{ $registration->start_date }}"
                                data-end_date="{{ $registration->end_date }}"
                                data-proposal="{{ asset('storage/' . $registration->proposal) }}"
                            >
                                Detail
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Overlay -->
    <div id="detailModal" class="modal-overlay">
        <div class="modal-content">
            <h2>Detail Pendaftar</h2>
            <p><strong>Nama:</strong> <span id="modalNama"></span></p>
            <p><strong>Program Studi:</strong> <span id="modalFakultas"></span></p>
            <p><strong>Judul Penelitian:</strong> <span id="modalJudul"></span></p>
            <p><strong>Nomor Telepon:</strong> <span id="modalTelepon"></span></p>
            <p><strong>Instansi:</strong> <span id="modalInstansi"></span></p>
            <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
            <p><strong>Tujuan Penelitian:</strong> <span id="modalTujuan"></span></p>
            <p><strong>Waktu Penelitian:</strong> <span id="modalWaktu"></span></p>
            
            <div class="modal-actions">
                <div class="left-actions">
                    <button class="close-btn" id="closeModal">Tutup</button>
                </div>
                <div class="right-actions">
                    <button class="accept-btn" id="acceptBtn">Terima</button>
                    <button class="pdf-btn" id="viewPdfBtn">Lihat PDF</button>
                    <button class="reject-btn" id="rejectBtn">Tolak</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* CSS untuk tampilan admin dan modal */
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
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
            cursor: pointer;
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
            background: rgba(0, 0, 0, 0.5);
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .left-actions {
            flex: 1;
        }
        .right-actions {
            display: flex;
            gap: 10px;
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
        .accept-btn {
            background: #28a745;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .accept-btn:hover {
            background: #218838;
        }
        .pdf-btn {
            background: #17a2b8;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .pdf-btn:hover {
            background: #138496;
        }
        .reject-btn {
            background: #dc3545;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .reject-btn:hover {
            background: #c82333;
        }
    </style>

    <script>
        const detailButtons = document.querySelectorAll('.detail-btn');
        const detailModal = document.getElementById('detailModal');
        const closeModalBtn = document.getElementById('closeModal');
        const acceptBtn = document.getElementById('acceptBtn');
        const rejectBtn = document.getElementById('rejectBtn');
        const viewPdfBtn = document.getElementById('viewPdfBtn');
        let currentRegistrationId = null;
        let currentProposal = null;

        detailButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                currentRegistrationId = this.getAttribute('data-id');
                currentProposal = this.getAttribute('data-proposal');

                document.getElementById('modalNama').textContent = this.getAttribute('data-nama');
                document.getElementById('modalFakultas').textContent = this.getAttribute('data-fakultas');
                document.getElementById('modalJudul').textContent = this.getAttribute('data-judul');
                document.getElementById('modalTelepon').textContent = this.getAttribute('data-telepon');
                document.getElementById('modalInstansi').textContent = this.getAttribute('data-instansi');
                document.getElementById('modalAlamat').textContent = this.getAttribute('data-alamat');
                document.getElementById('modalTujuan').textContent = this.getAttribute('data-tujuan');
                document.getElementById('modalWaktu').textContent = this.getAttribute('data-start_date') + ' sampai ' + this.getAttribute('data-end_date');
                
                detailModal.style.display = 'flex';
            });
        });

        closeModalBtn.addEventListener('click', function() {
            detailModal.style.display = 'none';
        });

        function updateStatus(status) {
            if (!currentRegistrationId) return;
            fetch(`/pkl-registrations/${currentRegistrationId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                detailModal.style.display = 'none';
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }

        acceptBtn.addEventListener('click', function() {
            updateStatus('accepted');
        });

        rejectBtn.addEventListener('click', function() {
            updateStatus('rejected');
        });

        viewPdfBtn.addEventListener('click', function() {
            if(currentProposal) {
                window.open(currentProposal, '_blank');
            }
        });
    </script>
@endsection
