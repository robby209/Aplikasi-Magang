<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PklRegistration;

class RiwayatController extends Controller
{
    public function showProgress()
    {
        // Ambil data pendaftaran PKL berdasarkan user yang sedang login
        $registration = PklRegistration::where('user_id', auth()->user()->id)->first();

        if ($registration) {
            $riwayatPermohonan = [
                [
                    'status'            => $registration->status,
                    'keterangan_status' => $this->getKeteranganStatus($registration->status),
                    'created_at'        => $registration->updated_at ?? $registration->created_at, // Pakai created_at jika updated_at null
                ]
            ];
        } else {
            $riwayatPermohonan = []; 
        }

        return view('progress', compact('riwayatPermohonan'));
    }

    //Fungsi untuk memetakan status ke keterangan permohonan yang diinginkan.

    private function getKeteranganStatus($status)
    {
        if (!$status) {
            return 'Status tidak diketahui';
        }

        $status = strtolower($status); 

        switch ($status) {
            case 'pending':
                return 'Pemohon Mengajukan Izin Penelitian (Menunggu Verifikasi)';
            case 'accepted':
                return 'Verifikator Menyetujui Izin Penelitian';
            case 'rejected':
                return 'Verifikator Menolak Izin Penelitian';
            default:
                return ucfirst($status);
        }
    }
}
