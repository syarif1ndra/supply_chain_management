@extends('admin.app')
@section('title', 'Pengiriman')
@section('navbar', 'Pengiriman')

@section('content')
    <div>
        <!-- Pengiriman -->
        <h1 class="text-2xl font-bold text-center mt-4 mb-6">Daftar Pengiriman</h1>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-200 text-gray-800">
                    <tr class="divide-x divide-gray-300">
                        <th class="py-3 px-6 text-left rounded-ss-lg">No</th>
                        <th class="py-3 px-6 text-left">Order</th>
                        <th class="py-3 px-6 text-left">Tanggal Kirim</th>
                        <th class="py-3 px-6 text-left">Tanggal Selesai</th>
                        <th class="py-3 px-6 text-left rounded-se-lg">Status Pengiriman</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-300">
                    @forelse ($pengiriman as $item)
                        <tr class="divide-x divide-gray-300 hover:bg-gray-100 transition duration-300">
                            <td class="py-3 px-6 text-left">{{ $item->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $item->orderMaterial->nomor_order }}</td>
                            <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($item->tanggal_kirim)->format('d M Y, H:i') }}</td>
                            <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y, H:i') }}</td>
                            <td class="py-3 px-6 text-left">{{$item->status_pengiriman}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-3 px-6 text-gray-500">Tidak ada data pengiriman ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 flex justify-center">
            {{ $pengiriman->links('vendor.pagination.custom-pagination') }}
    </div>
    </div>
@endsection
