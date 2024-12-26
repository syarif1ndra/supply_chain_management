<?php

namespace App\Http\Controllers;

use App\Models\OrderMaterial;
use Illuminate\Http\Request;

class AlurRantaiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data dari tabel ordermaterial dengan filter bulan dan tahun jika ada
        $query = OrderMaterial::select('id', 'nama_material', 'nama_pemasok', 'jumlah_order', 'tanggal_order');

        // Filter berdasarkan bulan jika ada parameter bulan
        if ($request->has('bulan') && $request->has('tahun')) {
            $bulan = $request->input('bulan');
            $tahun = $request->input('tahun');
            // Filter berdasarkan bulan dan tahun
            $query->whereMonth('tanggal_order', $bulan)
                  ->whereYear('tanggal_order', $tahun);
        }
        // Filter hanya berdasarkan bulan jika hanya bulan yang ada
        elseif ($request->has('bulan')) {
            $bulan = $request->input('bulan');
            $query->whereMonth('tanggal_order', $bulan);
        }
        // Filter hanya berdasarkan tahun jika hanya tahun yang ada
        elseif ($request->has('tahun')) {
            $tahun = $request->input('tahun');
            $query->whereYear('tanggal_order', $tahun);
        }

        // Ambil data yang sudah difilter
        $dataOrders = $query->get();

        return view('admin.alur_rantai.index', compact('dataOrders'));
    }
}
