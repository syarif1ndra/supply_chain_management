<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KontrakController extends Controller
{
    public function index()
    {
        $kontrak = Kontrak::orderBy('id', 'asc')->paginate(10);
        return view('admin.kontrak.home', compact('kontrak'));
    }


    public function create()
    {
        $pemasoks = \App\Models\Pemasok::all();
        return view('admin.kontrak.create', compact('pemasoks'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'bukti_kontrak' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        $user_id = Auth::id();
        if ($request->hasFile('bukti_kontrak')) {
            $filePath = $request->file('bukti_kontrak')->store('kontrak_bukti', 'public');
        }

        Kontrak::create([
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'bukti_kontrak' => $filePath ?? null,
            'user_id' => $user_id,
        ]);

        return redirect()->route('admin.kontrak.home')->with('success', 'Kontrak berhasil ditambahkan.');
    }




    public function edit($id)
    {
        if (Auth::user()->usertype !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit kontrak.');
        }

        $kontrak = Kontrak::findOrFail($id);
        return view('admin.kontrak.edit', compact('kontrak'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'bukti_kontrak' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        if (Auth::user()->usertype !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk memperbarui kontrak.');
        }

        $kontrak = Kontrak::findOrFail($id);

        if ($request->hasFile('bukti_kontrak')) {
            if ($kontrak->bukti_kontrak && Storage::exists('public/' . $kontrak->bukti_kontrak)) {
                Storage::delete('public/' . $kontrak->bukti_kontrak);
            }


            $filePath = $request->file('bukti_kontrak')->store('kontrak_bukti', 'public');
            $kontrak->bukti_kontrak = $filePath;
        }


        $kontrak->update([
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);


        return redirect()->route('admin.kontrak.home')->with('success', 'Kontrak berhasil diperbarui.');
    }


    public function destroy($id)
    {

        if (Auth::user()->usertype !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus kontrak.');
        }


        $kontrak = Kontrak::findOrFail($id);


        if ($kontrak->bukti_kontrak && Storage::exists('public/' . $kontrak->bukti_kontrak)) {
            Storage::delete('public/' . $kontrak->bukti_kontrak);
        }


        $kontrak->delete();

        return redirect()->route('admin.kontrak.home')->with('success', 'Kontrak berhasil dihapus.');
    }
}
