<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
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

        $request->validate([
            'name'    => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data user
        $user->name = $request->name;

        // Update data PKL Registration
        if ($user->pklRegistration) {
            $user->pklRegistration->telepon = $request->telepon;
            $user->pklRegistration->save();
        } else {
            // Jika belum ada data PKL Registration, buat baru
            PklRegistration::create([
                'user_id' => $user->id,
                'telepon' => $request->telepon
            ]);
        }

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

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }
}