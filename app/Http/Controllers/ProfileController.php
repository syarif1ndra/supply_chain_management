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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_photos', 'public');

            if (!empty($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->photo = $photoPath;
        }

        $user->save();

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

        if ($user->usertype === 'admin') {
            return redirect()->route('admin.profile.show')->with('success', 'Password admin berhasil diperbarui.');
        }

        return redirect()->route('profile.show')->with('success', 'Password berhasil diperbarui.');
    }
}
