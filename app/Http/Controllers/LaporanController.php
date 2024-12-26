<?php



namespace App\Http\Controllers;

use App\Models\Laporan;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with(['proyek', 'detailProyek'])->get();

        return view('admin.laporan.index', compact('laporans'));
    }
}
