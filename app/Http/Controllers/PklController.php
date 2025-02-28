<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PklRegistration;
use Illuminate\Support\Facades\Auth;

class PklController extends Controller
{
    public function register(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Validasi input dengan custom error message (Bahasa Indonesia)
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'nim'          => 'required|string|max:50',
            'alamat'       => 'required|string|max:255',
            'pekerjaan'    => 'required|string|max:255',
            'fakultas'     => 'required|string|max:255',
            'instansi'     => 'required|string|max:255',
            'telepon'      => 'required|string|max:50',
            'proposal'     => 'required|file|mimetypes:application/pdf,application/x-pdf,application/octet-stream|max:20480',
            'judul'        => 'required|string|max:255',
            'tujuan'       => 'required|string',
            'anggota'      => 'required|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date|after_or_equal:start_date',
        ], [
            'name.required'         => 'Kolom Nama wajib diisi.',
            'nim.required'          => 'Kolom NIM wajib diisi.',
            'alamat.required'       => 'Kolom Alamat wajib diisi.',
            'pekerjaan.required'    => 'Kolom Pekerjaan/Jabatan wajib diisi.',
            'fakultas.required'     => 'Kolom Fakultas/Program Studi wajib diisi.',
            'instansi.required'     => 'Kolom Instansi/Organisasi wajib diisi.',
            'telepon.required'      => 'Kolom Nomor Telepon wajib diisi.',
            'proposal.required'     => 'File Proposal (PDF) wajib diunggah.',
            'proposal.max'          => 'Ukuran file tidak boleh lebih dari 20MB.',
            'proposal.mimetypes'    => 'File proposal harus berformat PDF.',
            'judul.required'        => 'Judul Penelitian wajib diisi.',
            'tujuan.required'       => 'Tujuan Penelitian wajib diisi.',
            'anggota.required'      => 'Kolom Anggota/Peserta wajib diisi.',
            'start_date.required'   => 'Tanggal Mulai wajib diisi.',
            'end_date.required'     => 'Tanggal Selesai wajib diisi.',
            'end_date.after_or_equal'=> 'Tanggal Selesai tidak boleh sebelum Tanggal Mulai.',
        ]);

        // Proses upload file proposal
        $file = $request->file('proposal');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $proposalPath = $file->storeAs('proposals', $fileName, 'public');

        // Simpan data pendaftaran ke database
        $registration = new PklRegistration();
        $registration->user_id    = Auth::id();
        $registration->nama       = $validated['name'];
        $registration->nim        = $validated['nim'];
        $registration->alamat     = $validated['alamat'];
        $registration->pekerjaan  = $validated['pekerjaan'];
        $registration->fakultas   = $validated['fakultas'];
        $registration->instansi   = $validated['instansi'];
        $registration->telepon    = $validated['telepon'];
        $registration->proposal   = $proposalPath;
        $registration->judul      = $validated['judul'];
        $registration->tujuan     = $validated['tujuan'];
        $registration->anggota    = $validated['anggota'];
        $registration->start_date = $validated['start_date'];
        $registration->end_date   = $validated['end_date'];
        // Status default 'pending' diatur oleh migration
        $registration->save();

        return redirect()->back()->with('success', 'Pendaftaran PKL berhasil disimpan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $registration = PklRegistration::findOrFail($id);
        $registration->status = $request->input('status');
        $registration->save();

        return response()->json(['message' => 'Status pendaftaran berhasil diperbarui.']);
    }
}
