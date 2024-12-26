<?php

namespace App\Http\Controllers;

use App\Models\MaterialPemasok;
use App\Models\Pengiriman;
use App\Models\User;
use App\Models\OrderMaterial;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengirimanController extends Controller
{
    /**
     * Menampilkan daftar pengiriman.
     */
    public function index()
    {
        $pengiriman = Pengiriman::with('orderMaterial')->paginate(10);
        $totalPengiriman = Pengiriman::count();

        return view('user.pengiriman.home', compact('pengiriman', 'totalPengiriman'));
    }

    public function indexForAdmin()
    {
        $pengiriman = Pengiriman::with('orderMaterial')->paginate(10);
        $totalPengiriman = Pengiriman::count();

        return view('admin.pengiriman.index', compact('pengiriman', 'totalPengiriman'));
    }


    /**
     * Menampilkan daftar pengiriman untuk pengguna.
     */


    /**
     * Menampilkan form untuk membuat pengiriman baru.
     */
    public function create()
    {
        $orderMaterials = OrderMaterial::whereDoesntHave('pengiriman')->get();
        return view('user.pengiriman.create', compact('orderMaterials'));
    }

    /**
     * Menyimpan data pengiriman baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_order' => 'required|string|exists:order_material,nomor_order',
            'tanggal_kirim' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_kirim',
            'status_pengiriman' => 'required|string|max:255',
        ]);

        $orderMaterial = OrderMaterial::where('nomor_order', $validated['nomor_order'])->first();
        if (!$orderMaterial) {
            return redirect()->back()->withErrors(['nomor_order' => 'Nomor order tidak ditemukan.']);
        }

        Pengiriman::create([
            'order_id' => $orderMaterial->id,
            'tanggal_kirim' => $validated['tanggal_kirim'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'status_pengiriman' => $validated['status_pengiriman'],
        ]);



        return redirect()->route('user.pengiriman')->with('success', 'Pengiriman berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data pengiriman.
     */
    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $orderMaterials = OrderMaterial::all();
        return view('user.pengiriman.edit', compact('pengiriman', 'orderMaterials'));
    }

    /**
     * Memperbarui data pengiriman.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_order' => 'required|string|exists:order_material,nomor_order',
            'tanggal_kirim' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_kirim',
            'status_pengiriman' => 'required|string|max:255',
        ]);

        $pengiriman = Pengiriman::findOrFail($id);

        $orderMaterial = OrderMaterial::where('nomor_order', $validated['nomor_order'])->first();
        if (!$orderMaterial) {
            return redirect()->back()->withErrors(['nomor_order' => 'Nomor order tidak ditemukan.']);
        }

        $pengiriman->update([
            'order_id' => $orderMaterial->id,
            'tanggal_kirim' => $validated['tanggal_kirim'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'status_pengiriman' => $validated['status_pengiriman'],
        ]);

        return redirect()->route('user.pengiriman')->with('success', 'Pengiriman berhasil diperbarui.');
    }


    /**
     * Menghapus data pengiriman.
     */
    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->delete();

        return redirect()->route('user.pengiriman')->with('success', 'Pengiriman berhasil dihapus.');
    }

    /**
     * Menghitung sisa hari sebelum tanggal selesai.
     */
    public function hitungSisaHari($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        if ($pengiriman->tanggal_selesai) {
            $sisaHari = Carbon::now()->diffInDays(Carbon::parse($pengiriman->tanggal_selesai), false);

            return $sisaHari >= 0
                ? "Sisa waktu: {$sisaHari} hari."
                : "Tanggal selesai sudah terlewati.";
        }

        return "Tanggal selesai belum ditentukan.";
    }
}
