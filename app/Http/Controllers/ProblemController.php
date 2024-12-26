<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\OrderMaterial;
use App\Models\MaterialProyek;
use App\Models\Proyek;
use App\Models\DetailProyek;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function index()
    {
        $problems = Problem::paginate(10);
        return view('admin.problem.index', compact('problems'));
    }

    public function create()
    {
        $orderMaterials = OrderMaterial::all();
        $materialProyek = MaterialProyek::all();
        $proyek = Proyek::all();
        $detailProyek = DetailProyek::all();


        return view('admin.problem.create', compact('orderMaterials', 'materialProyek', 'proyek', 'detailProyek'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_order' => 'required|string|exists:order_material,nomor_order',
            'nama_material' => 'required',
            'jumlah_order' => 'required|integer',
            'stok' => 'required|integer',
            'nama_proyek' => 'required',
            'keterangan' => 'nullable|string',
            'jumlah_digunakan' => 'required|integer',


        ]);

        Problem::create($request->all());

        return redirect()->route('admin.problem.index')->with('success', 'Data problem berhasil disimpan!');
    }


    public function edit($id)
    {
        $problem = Problem::findOrFail($id);
        $orderMaterials = OrderMaterial::all();
        $materialProyek = MaterialProyek::all();
        $proyek = Proyek::all();
        $detailProyek = DetailProyek::all();

        return view('admin.problem.edit', compact('problem', 'orderMaterials', 'materialProyek', 'proyek', 'detailProyek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_order' => 'required|string|exists:order_material,nomor_order',
            'nama_material' => 'required',
            'jumlah_order' => 'required|integer',
            'stok' => 'required|integer',
            'nama_proyek' => 'required',
            'keterangan' => 'nullable|string',
            'jumlah_digunakan' => 'required|integer',
        ]);

        $problem = Problem::findOrFail($id);
        $problem->update($request->all());

        return redirect()->route('admin.problem.index')->with('success', 'Data problem berhasil diperbarui!');
    }


    public function getOrderDetails($nomorOrder)
    {
        $order = OrderMaterial::where('nomor_order', $nomorOrder)->first();

        if ($order) {
            return response()->json([
                'nama_material' => $order->nama_material,
                'jumlah_order' => $order->jumlah_order,
            ]);
        }

        return response()->json([], 404);
    }

    public function destroy($id)
    {
        $problem = Problem::findOrFail($id);
        $problem->delete();

        return redirect()->route('admin.problem.index')->with('success', 'Data problem berhasil dihapus!');
    }
}
