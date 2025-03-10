<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PklRegistration;

class ProfileController extends Controller
{
    /**
     * Memperbarui data profil user.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name'    => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika user belum punya pklRegistration, suruh isi form dulu
        if (!$user->pklRegistration) {
            // Alihkan ke form PKL atau kembali ke profil dengan pesan kesalahan
            return redirect()
                ->route('profile') // Ganti ke route lain jika perlu, misalnya 'pkl.form'
                ->withErrors(['msg' => 'Silakan isi form PKL terlebih dahulu!']);
        }

        // Update data user
        $user->name = $request->name;

        // Update data PKL Registration (tanpa menimbulkan error)
        $user->pklRegistration()->update([
            'telepon' => $request->telepon,
        ]);

        // Handle upload foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo_path) {
                Storage::disk('public')->delete($user->photo_path);
            }

            // Simpan foto baru
            $path = $request->file('photo')->store('profile_images', 'public');
            $user->photo_path = $path;
        }

        // Simpan perubahan user
        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
