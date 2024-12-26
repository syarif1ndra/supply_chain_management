<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Proyek;
use App\Models\Pemasok;
use App\Models\MaterialPemasok;
use App\Models\Kontrak;
use App\Models\MaterialProyek;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengiriman = Pengiriman::count();

        $totalProyek = Proyek::count();

        $totalPemasok = Pemasok::count();

        $totalMaterialPemasok = MaterialPemasok::count();
        $totalMaterialProyek = MaterialProyek::count();

        $totalKontrak = Kontrak::count();

        return view('admin.dashboard', compact(
            'totalPengiriman',
            'totalProyek',
            'totalPemasok',
            'totalMaterialPemasok',
            'totalKontrak',
            'totalMaterialProyek'
        ));
    }

    public function userDashboard()
    {
        $totalPengiriman = Pengiriman::count();

        $totalMaterialPemasok = MaterialPemasok::count();

        $totalKontrak = Kontrak::count();

        return view('user.dashboard', compact(
            'totalPengiriman',
            'totalMaterialPemasok',
            'totalKontrak'
        ));
    }
}
