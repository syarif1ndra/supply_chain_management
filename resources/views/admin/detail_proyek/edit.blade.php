@extends('admin.app')
@section('title', 'Update Detail Proyek')
@section('navbar', 'Edit Detail Proyek')

@section('content')
<div>
        <div class="container">
            <div class="card" style="width: 40rem;margin: auto;">
                <div class="card-body px-4">
                    <h1 class="fs-3 fw-bold mb-3 text-center">Update Detail Proyek</h1>
                    <form action="{{ route('admin.detail_proyek.update', ['proyek_id' => $detail_proyek->proyek_id, 'id' => $detail_proyek->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
    
                        <!-- Proyek ID, hanya tampil dan tidak bisa diubah -->
                        <div class="mb-3">
                            <label for="proyek_id" class="form-label">Proyek ID</label>
                            <input class="form-control" id="proyek_id" name="proyek_id" value="{{ $detail_proyek->proyek_id }}" readonly>
                        </div>
    
                        <!-- Material ID (hidden) -->
                        <input type="hidden" name="material_id" value="{{ $detail_proyek->material_id }}">
    
                        <!-- Nama Material, ambil dari relasi -->
                        <div class="mb-3">
                            <label for="nama_material" class="form-label">Nama Material</label>
                            <input class="form-control" id="nama_material" value="{{ $detail_proyek->materialProyek->nama_material ?? 'Material tidak tersedia' }}" readonly>
                        </div>
    
                        <div class="mb-3">
                            <label for="jumlah_digunakan" class="form-label">Jumlah Digunakan</label>
                            <input class="form-control" id="jumlah_digunakan" name="jumlah_digunakan" value="{{ $detail_proyek->jumlah_digunakan }}">
                        </div>
    
                        <div class="mb-3">
                            <label for="tanggal_digunakan" class="form-label">Tanggal Digunakan</label>
                            <input class="form-control" id="tanggal_digunakan" name="tanggal_digunakan" type="date"  value="{{ $detail_proyek->tanggal_digunakan }}">
                        </div>
    
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input class="form-control" id="keterangan" name="keterangan" value="{{ $detail_proyek->keterangan }}">
                        </div>
    
                        <!-- Biaya Penggunaan, tidak bisa diubah -->
                        <div class="mb-3">
                            <label for="biaya_penggunaan" class="form-label">Biaya Penggunaan</label>
                            <input class="form-control" id="biaya_penggunaan" name="biaya_penggunaan" value="{{ $detail_proyek->biaya_penggunaan }}" readonly>
                        </div>
    
                        <button type="submit" class="btn btn-warning w-100">Update Detail Proyek</button>
                    </form>
                    <div class="mt-3 mb-3 text-center">
                        <a href="{{ route('admin.detail_proyek.index', ['proyek_id' => $detail_proyek->proyek_id]) }}" class="btn btn-outline-secondary w-25">Kembali</a>
                    </div>
                </div>

            </div>
        </div>
</div>
@endsection
