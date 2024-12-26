<?php

namespace App\Http\Controllers;

use App\Models\MaterialPemasok;
use App\Models\OrderMaterial;
use Illuminate\Http\Request;

class OrderMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua order material beserta relasi material dan pemasoknya
        $orders = OrderMaterial::with('materialPemasok')->paginate(10);

        return view('admin.order.home', compact('orders'));
    }

    public function indexForUser()
    {
        // Mengambil semua order material beserta relasi material dan pemasoknya
        $orders = OrderMaterial::with('materialPemasok')->paginate(10);

        return view('user.order.home', compact('orders'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data material dan pemasok yang terkait
        $materials = MaterialPemasok::with('pemasok')->get();
        return view('admin.order.create', compact('materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input yang diterima
        $validated = $request->validate([
            'material_id' => 'required|exists:material_pemasok,id',  // Pastikan ID material ada di tabel material_pemasok
            'jumlah_order' => 'required|integer',
            'satuan' => 'required|in:unit,box', // Validasi satuan
            'tanggal_order' => 'required|date',
            'keterangan' => 'nullable|string',
            'harga_satuan' => 'required|numeric',  // Validasi harga_satuan
        ]);

        // Ambil material berdasarkan ID yang dipilih
        $material = MaterialPemasok::find($validated['material_id']);

        if (!$material) {
            return redirect()->back()->withErrors(['material' => 'Material tidak ditemukan.']);
        }

        // Periksa stok material
        if ($material->stok < $validated['jumlah_order']) {
            return redirect()->back()->withErrors(['stok' => 'Stok material tidak mencukupi.']);
        }

        // Kurangi stok material sesuai jumlah order
        $material->stok -= $validated['jumlah_order'];
        $material->save();

        // Generate nomor order
        $tanggalSekarang = now()->format('Ymd'); // Format tanggal: YYYYMMDD
        $countToday = OrderMaterial::whereDate('tanggal_order', now()->toDateString())->count();
        $nomorOrder = 'ORD-' . $tanggalSekarang . '-' . str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

        // Pastikan nomor order unik
        while (OrderMaterial::where('nomor_order', $nomorOrder)->exists()) {
            $countToday++;
            $nomorOrder = 'ORD-' . $tanggalSekarang . '-' . str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);
        }


        // Simpan data order material ke database
        OrderMaterial::create([
            'material_id' => $material->id,
            'jumlah_order' => $validated['jumlah_order'],
            'satuan' => $validated['satuan'], // Menyimpan satuan
            'tanggal_order' => $validated['tanggal_order'],
            'keterangan' => $validated['keterangan'],
            'nama_material' => $material->nama_material,  // Simpan nama material
            'nama_pemasok' => $material->pemasok->nama_pemasok,  // Simpan nama pemasok
            'harga_satuan' => $material->harga_satuan,  // Simpan harga satuan
            'nomor_order' => $nomorOrder,
        ]);



        return redirect()->route('admin.order')->with('success', 'Order Material berhasil ditambahkan dan stok material telah diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderMaterial $orderMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $order = OrderMaterial::find($id);
        $materials = MaterialPemasok::all(); // Ambil semua data material pemasok
        return view('admin.order.edit', compact('order', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validasi input
        $validated = $request->validate([
            'material_id' => 'required|exists:material_pemasok,id',  // Pastikan ID material valid
            'jumlah_order' => 'required|integer|min:1',  // Pastikan jumlah_order lebih dari 0
            'satuan' => 'required|in:unit,box', // Validasi satuan
            'tanggal_order' => 'required|date',  // Pastikan tanggal valid
            'keterangan' => 'required|string',
            'harga_satuan' => 'required|numeric',  // Validasi harga_satuan

            // Pastikan keterangan valid
        ]);

        $order = OrderMaterial::find($id);
        if (!$order) {
            return redirect()->back()->withErrors(['order' => 'Order tidak ditemukan.']);
        }

        $material = MaterialPemasok::find($validated['material_id']);

        if (!$material) {
            return redirect()->back()->withErrors(['material' => 'Material tidak ditemukan.']);
        }

        // Update stok material lama (tambahkan kembali stok)
        $oldMaterial = MaterialPemasok::find($order->material_id);
        if ($oldMaterial) {
            $oldMaterial->stok += $order->jumlah_order;
            $oldMaterial->save();
        }

        // Periksa stok material baru
        if ($material->stok < $validated['jumlah_order']) {
            return redirect()->back()->withErrors(['stok' => 'Stok material tidak mencukupi.']);
        }

        // Kurangi stok material baru
        $material->stok -= $validated['jumlah_order'];
        $material->save();

        // Update data order material
        $order->update([
            'material_id' => $material->id,
            'jumlah_order' => $validated['jumlah_order'],
            'satuan' => $validated['satuan'], // Update satuan
            'tanggal_order' => $validated['tanggal_order'],
            'keterangan' => $validated['keterangan'],
            'nama_material' => $material->nama_material,
            'nama_pemasok' => $material->pemasok->nama_pemasok,
            'harga_satuan' => $material->harga_satuan, // Update harga satuan
        ]);

        return redirect()->route('admin.order')->with('success', 'Order Material berhasil diupdate.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = OrderMaterial::find($id);
        if ($order) {
            $order->delete();
            return redirect()->route('admin.order')->with('success', 'Order material berhasil dihapus.');
        } else {
            return redirect()->route('admin.order')->with('error', 'Order material tidak ditemukan.');
        }
    }



    public function trends()
    {
        // Hitung total order per material dan urutkan dari jumlah terbanyak
        $trends = OrderMaterial::select('nama_material', \DB::raw('SUM(jumlah_order) as total_order'))
            ->groupBy('nama_material')
            ->orderByDesc('total_order')
            ->paginate(10); // Menambahkan pagination di sini, 10 data per halaman


        return view('admin.order.trends', compact('trends'));
    }

}
