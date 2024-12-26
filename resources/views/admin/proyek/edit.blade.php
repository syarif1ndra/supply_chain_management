@extends('admin.app')
@section('title', 'Material')
@section('navbar', 'Edit Proyek')

@section('content')
  <div class="d-flex justify-content-center">
    <div class="card shadow" style="width: 40rem;">
      <div class="card-body">
        <h1 class="text-center fs-3 fw-bold mt-3">Edit Proyek</h1>
        <form action="{{ route('admin.proyek.update', $proyek->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input type="hidden" class="form-control" id="id_material" name="id_material" value="" required>
            </div>

            <div class="mb-3">
                <label for="nama_proyek" class="form-label">Nama Proyek</label><br>
                <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" value="{{ $proyek->nama_proyek }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status Proyek</label>
                <select class="form-select" id="status" name="status">
                    <option value="aktif" {{ $proyek->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ $proyek->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="tertunda" {{ $proyek->status == 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label><br>
                <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ $proyek->lokasi }}" required>
            </div>

         

            <div class="mb-3">
                <input type="submit" value="Update" class="btn btn-warning form-control" name="submit">
            </div>
        </form>
        <div class="mt-3 text-center">
          <a href="{{ route('admin.proyek') }}" class="btn btn-outline-secondary mb-2 rounded ps-3 ">Kembali</a>
        </div>
      </div>
    </div>
  </div>
@endsection
