@extends('admin.app')
@section('title', 'Daftar Order Material')
@section('navbar', 'Order')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto">
        <div class="bg-gray-100">
            <div class="max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex justify-start space-x-8 border-b-2 border-gray-200">
                    <a href="{{ route('admin.material') }}" class="py-4 px-1 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Material</a>
                    <a href="{{ route('admin.order') }}" class="py-4 px-1 border-b-2 border-black font-medium text-gray-900">Order</a>
                </div>
            </div>
        </div>

        <!-- Header with Button to add order and Title -->
        <div class="flex justify-between items-center mt-4 mb-3">
            <a href="{{ route('admin.order.create') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-gray-700 transition duration-300">
                <i class="fas fa-plus mr-2"></i>Tambah Order
            </a>
        </div>

        <!-- Order Material List -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-black font-semibold uppercase text-sm">
                    <tr class="divide-x divide-gray-300">
                        <th class="py-3 px-6 text-left rounded-ss-lg">Nomor Order</th>
                        <th class="py-3 px-6 text-left">Nama Material</th>
                        <th class="py-3 px-6 text-left">Nama Pemasok</th>
                        <th class="py-3 px-6 text-left">Harga Satuan</th>
                        <th class="py-3 px-6 text-left">Jumlah Order</th>
                        <th class="py-3 px-6 text-left">Satuan</th>
                        <th class="py-3 px-6 text-left">Tanggal Order</th>
                        <th class="py-3 px-6 text-left">Keterangan</th>
                        <th class="py-3 px-6 text-center rounded-se-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-300">
                    @forelse ($orders as $order)
                        <tr class="divide-x divide-gray-300 hover:bg-gray-100 transition duration-300">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $order->nomor_order }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->material->nama_material ?? 'Material Tidak Ditemukan' }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->pemasok->nama_pemasok ?? 'Pemasok Tidak Ditemukan' }}</td>
                            <td class="py-3 px-6 text-left">{{ number_format($order->harga_satuan, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->jumlah_order }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->satuan }}</td>
                            <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y') }}</td>
                            <td class="py-3 px-6 text-left">{{ $order->keterangan }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.order.edit', $order->id) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-3 px-6 text-center text-gray-500">Tidak ada order material yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4 flex justify-center">
            {{ $orders->links('vendor.pagination.custom-pagination') }} <!-- Pagination links standar Laravel -->
        </div>

    </div>

</body>
</html>
@endsection
