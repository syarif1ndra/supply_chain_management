<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan profil pengguna.
     */
    public function show()
    {
        // Cek apakah user yang sedang login adalah admin
        if (auth()->user()->usertype === 'admin') {
            return view('admin.profile.show', [
                'user' => auth()->user(),
            ]);
        }

        return view('profile.show', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        // Cek apakah user yang sedang login adalah admin
        if (auth()->user()->usertype === 'admin') {
            return view('admin.profile.edit', [
                'user' => auth()->user(),
            ]);
        }

        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Memperbarui profil pengguna.
     */
      public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi input termasuk foto
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // Maksimal 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update data pengguna
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Jika ada file foto diunggah
        if ($request->hasFile('photo')) {
            // Simpan file baru di storage
            $photoPath = $request->file('photo')->store('profile_photos', 'public');

            // Hapus foto lama jika ada
            if (!empty($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Simpan path foto baru
            $user->photo = $photoPath;
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect berdasarkan tipe pengguna
        if ($user->usertype === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Profil admin berhasil diperbarui.');
        }

        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Menampilkan halaman ubah password untuk pengguna atau admin.
     */
    public function changePassword()
    {
        // Cek apakah user yang sedang login adalah admin
        if (auth()->user()->usertype === 'admin') {
            return view('admin.profile.change_password');
        }

        return view('profile.change_password');
    }

    /**
     * Memperbarui password pengguna atau admin.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Cek jika pengguna adalah admin
        if ($user->usertype === 'admin') {
            return redirect()->route('admin.profile.show')->with('success', 'Password admin berhasil diperbarui.');
        }

        return redirect()->route('profile.show')->with('success', 'Password berhasil diperbarui.');
    }

}
