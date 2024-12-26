@extends('layouts.app')
@section('title', 'Pengiriman')
@section('navbar', 'Pengiriman')

@section('content')
    <!-- Content -->
    <div>
        <div class="d-flex justify-content-between mt-4 mb-2">
            <!-- Tambah -->
            <div>
                <a href="{{ route('user.pengiriman.create') }}" class="btn bg-gray-500 hover:bg-gray-700 text-white"><i class="bi bi-plus-lg me-2"></i>Tambah Pengiriman</a>
            </div>
        </div>
        <!-- Pengiriman -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full bg-white table-auto">
                <thead class="bg-gray-50 text-black uppercase text-xs font-medium">
                    <tr class="divide-x divide-gray-200">
                        <th class="py-3 px-6 text-left rounded-ss-lg">No</th>
                        <th class="py-3 px-6 text-left">Nomor Order</th>
                        <th class="py-3 px-6 text-left">Tanggal Kirim</th>
                        <th class="py-3 px-6 text-left">Tanggal Selesai</th>
                        <th class="py-3 px-6 text-left">Status Pengiriman</th>
                        <th class="py-3 px-6 text-left rounded-se-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pengiriman as $item)
                        <tr class="divide-x divide-gray-200 hover:bg-gray-100 transition duration-300">
                            <td class="py-3 px-6 text-left">{{ $item->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $item->orderMaterial->nomor_order }}</td>
                            <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($item->tanggal_kirim)->format('d-m-Y H:i:s') }}</td>
                            <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y H:i:s') }}</td>
                            <td class="py-3 px-6 text-left">{{ $item->status_pengiriman }}</td>
                            <td class="py-3 px-6 text-left">
                                <!-- Action Buttons -->
                                <a href="{{ route('user.pengiriman.edit', $item->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300 mr-2" aria-label="Edit Pengiriman">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('user.pengiriman.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengiriman ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300" aria-label="Hapus Pengiriman">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-3 px-6 text-sm text-gray-500">Tidak ada data pengiriman ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex justify-center">
            {{ $pengiriman->links('vendor.pagination.custom-pagination') }} <!-- Pastikan menggunakan $pemasok untuk pagination -->
        </div>
    </div>
@endsection
