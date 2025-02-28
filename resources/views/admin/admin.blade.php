@extends('admin.dashboardAdmin')

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
                document.getElementById('modalWaktu').textContent = 
                    this.getAttribute('data-start_date') + ' sampai ' + this.getAttribute('data-end_date');
                
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
