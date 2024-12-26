@extends('admin.app')
@section('title', 'Daftar Detail Proyek')
@section('navbar','Detail Proyek')

@section('content')
<div>

    <!-- Tombol untuk kembali ke halaman sebelumnya -->
    <p>
        <a href="{{ route('admin.proyek', ['proyek_id' => $proyek_id]) }}" class="btn btn-outline-secondary mb-3">
            Kembali
        </a>
    </p>

    <div class="d-flex flex-row justify-content-between">
        <!-- Tombol untuk menambahkan proyek-->
         <div>
             <a href="{{ route('admin.detail_proyek.create', ['proyek_id' => $proyek_id]) }}" class="btn bg-gray-600 hover:bg-gray-700 text-white">
                 Tambah Detail Proyek
             </a>
         </div>

        <!-- Form Filter Tanggal -->
         <div class="mb-3">
             <form action="{{ route('admin.detail_proyek.index', ['proyek_id' => $proyek_id]) }}" method="GET" class="form-inline d-flex flex-row">
                <div class="d-flex flex-row me-2">
                    <label for="start_date" class="mt-2">Dari:</label>
                    <input type="date" name="start_date" value="{{ request()->get('start_date') }}" class="form-control mx-2">
                </div>
                <div class="d-flex flex-row">
                    <label for="end_date" class="mt-2">Hingga:</label>
                    <input type="date" name="end_date" value="{{ request()->get('end_date') }}" class="form-control mx-2">
                </div>
                 <button type="submit" class="btn bg-gray-600 hover:bg-gray-700 text-white">Filter</button>
             </form>
         </div>
    </div>


    <!-- Daftar Proyek -->
     <div class="d-flex flex-row justify-content-between mt-3">
        <div>
        </div>
         <!-- Form Ekspor PDF -->
        <div class="mb-2">
            <form action="{{ route('admin.detail_proyek.exportPDF', ['proyek_id' => $proyek_id]) }}" method="GET" class="form-inline">
                <input type="hidden" name="start_date" value="{{ request()->get('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request()->get('end_date') }}">

                <div class="d-flex flex-row justify-content-between">
                    <button type="submit" class="btn bg-red-500 text-white text-nowrap">Ekspor ke PDF</button>
                </div>
            </form>
        </div>
     </div>
     <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-400">
            <thead class="bg-gray-200 text-gray-800 font-bold">
                <tr class="divide-x divide-gray-300">
                    <th class="py-3 px-6 text-left rounded-ss-lg">No</th>
                    <th class="py-3 px-6 text-left">Proyek</th>
                    <th class="py-3 px-6 text-left">Material</th>
                    <th class="py-3 px-6 text-left">Jumlah Digunakan</th>
                    <th class="py-3 px-6 text-left">Harga Satuan</th>
                    <th class="py-3 px-6 text-left">Tanggal Digunakan</th>
                    <th class="py-3 px-6 text-left">Keterangan</th>
                    <th class="py-3 px-6 text-left">Biaya Penggunaan</th>
                    <th class="py-3 px-6 text-left rounded-se-lg">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-300">
                @forelse ($detail_proyek as $item)
                    <tr class="divide-x divide-gray-300 hover:bg-gray-100 transition duration-300">
                        <td class="px-6 py-3 text-sm">{{ $item->id }}</td>
                        <td class="px-6 py-3 text-sm">
                            {{ $item->proyek_id }} - {{ $item->proyek->nama_proyek ?? 'Tidak ada nama proyek' }}
                        </td>
                        <td class="px-6 py-3 text-sm">{{ $item->materialProyek->nama_material ?? 'Tidak ada material' }}</td>
                        <td class="px-6 py-3 text-sm">{{ $item->jumlah_digunakan }}</td>
                        <td class="px-6 py-3 text-sm">
                            {{ number_format($item->materialProyek->harga_satuan ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-3 text-sm">
                            {{ \Carbon\Carbon::parse($item->tanggal_digunakan)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-3 text-sm">{{ $item->keterangan }}</td>
                        <td class="px-6 py-3 text-sm">
                            {{ number_format($item->biaya_penggunaan ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-3 text-sm flex items-center space-x-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.detail_proyek.edit', ['proyek_id' => $proyek_id, 'id' => $item->id]) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.detail_proyek.destroy', ['proyek_id' => $proyek_id, 'id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-3 px-6 text-gray-500">
                            Tidak ada data ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4 flex justify-center">
            {{ $detail_proyek->links('vendor.pagination.custom-pagination') }}
  </div>
    </div>



</div>
@endsection
