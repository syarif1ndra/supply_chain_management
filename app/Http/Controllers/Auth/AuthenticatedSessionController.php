<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Pengiriman;
use App\Notifications\TanggalSelesaiNotification;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        $pesan_notifikasi = '';

        if ($user->usertype === 'user') {
            $pesan_notifikasi = "Selamat datang user";
        } else {
            $tanggal_selesai_terdekat = DB::table('pengiriman')
                ->where('status_pengiriman', '!=', 'batal')
                ->where('tanggal_selesai', '>', now())
                ->orderBy('tanggal_selesai', 'asc')
                ->value('tanggal_selesai');

            if ($tanggal_selesai_terdekat) {
                $selisih = now()->diff(Carbon::parse($tanggal_selesai_terdekat));

                $days = $selisih->d;
                $hours = $selisih->h;
                $minutes = $selisih->i;

                $pesan_notifikasi = "$days hari $hours jam $minutes menit lagi barang datang (tanggal: "
                    . Carbon::parse($tanggal_selesai_terdekat)->format('l, j F Y H:i:s') . ")";
            } else {
                $pesan_notifikasi = "Tidak ada pengiriman yang dijadwalkan.";
            }
        }

        session()->flash('status', $pesan_notifikasi);

        if ($user->usertype === 'admin') {
            return redirect('admin/dashboard');
        }

        return redirect()->intended(route('dashboard'));
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
