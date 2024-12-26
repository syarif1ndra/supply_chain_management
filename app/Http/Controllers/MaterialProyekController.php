<?php

namespace App\Http\Controllers;

use App\Models\DetailProyek;
use Illuminate\Http\Request;
use App\Models\MaterialProyek;
use App\Models\Pengiriman;
use App\Models\OrderMaterial;
use App\Models\Proyek;

class MaterialProyekController extends Controller
{
    /**
     * Menampilkan daftar material proyek.
     */
    public function index()
    {
        $materials = MaterialProyek::paginate(10);
        return view('admin.material_proyek.index', compact('materials'));
    }
    public function edit($id)
    {
        $material = MaterialProyek::findOrFail($id);
        $proyekList = Proyek::where('status', 'aktif')->get();
        return view('admin.material_proyek.edit', compact('material', 'proyekList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_material' => 'required',
            'stok' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'proyek_id' => 'required|exists:proyek,id,status,aktif',
        ]);

        $material = MaterialProyek::findOrFail($id);
        $material->update([
            'nama_material' => $request->nama_material,
            'stok' => $request->stok,
            'harga_satuan' => $request->harga_satuan,
            'proyek_id' => $request->proyek_id,
        ]);

        return redirect()->route('material_proyek.index')->with('success', 'Material proyek berhasil diperbarui!');
    }




    /**
     * Proses sinkronisasi data berdasarkan pengiriman yang selesai.
     */
    public function syncFromPengiriman()
    {
        $pengirimanSelesai = Pengiriman::where('status_pengiriman', 'selesai')->get();

        foreach ($pengirimanSelesai as $pengiriman) {
            $existingMaterial = MaterialProyek::where('pengiriman_id', $pengiriman->id)->first();

            if (!$existingMaterial) {
                $orderMaterial = $pengiriman->orderMaterial;
                if ($orderMaterial) {
                    $materialProyek = MaterialProyek::create([
                        'nama_material' => $orderMaterial->nama_material,
                        'stok' => $orderMaterial->jumlah_order,
                        'harga_satuan' => $orderMaterial->harga_satuan,
                        'pengiriman_id' => $pengiriman->id,
                        'material_id' => null,
                    ]);

                    $detailProyek = DetailProyek::where('material_id', $materialProyek->id)->get();

                    foreach ($detailProyek as $detail) {
                        $materialProyek->stok -= $detail->jumlah_digunakan;
                    }

                    $materialProyek->save();
                }
            }
        }

        return redirect()->route('material_proyek.index')->with('success', 'Data material proyek berhasil disinkronisasi!');
    }
}
