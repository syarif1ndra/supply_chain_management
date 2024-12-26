<?php

namespace App\Http\Controllers;

use App\Models\OrderMaterial;
use Illuminate\Http\Request;

class AlurRantaiController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderMaterial::select('id', 'nama_material', 'nama_pemasok', 'jumlah_order', 'tanggal_order');

        if ($request->has('bulan') && $request->has('tahun')) {
            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');
            $query->whereMonth('tanggal_order', $bulan)
                ->whereYear('tanggal_order', $tahun);
        } elseif ($request->has('bulan')) {
            $bulan = $request->input('bulan');
            $query->whereMonth('tanggal_order', $bulan);
        } elseif ($request->has('tahun')) {
            $tahun = $request->input('tahun');
            $query->whereYear('tanggal_order', $tahun);
        }

        $dataOrders = $query->get();

        return view('admin.alur_rantai.index', compact('dataOrders'));
    }
}
