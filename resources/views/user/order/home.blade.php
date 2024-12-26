@extends('layouts.app')
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
    <div class="container mx-auto px-4">
        <div class="bg-gray-100">
            <div class="max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="flex justify-start space-x-8 border-b-2 border-gray-200">
                    <a href="{{ route('user.material') }}" class="py-4 px-1 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Material</a>
                    <a href="{{ route('user.order') }}" class="py-4 px-1 border-b-2 border-black font-medium text-gray-900">Order</a>
                </div>
            </div>
        </div>

        <!-- Order Material List -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg mt-4">
            <table class="min-w-full bg-white table-auto">
                <thead class="bg-gray-50 text-black uppercase text-xs font-medium leading-normal">
                    <tr class="divide-x divide-gray-200">
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama Material</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama Pemasok</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Harga Satuan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Jumlah Order</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal Order</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr class="divide-x divide-gray-200 hover:bg-gray-100 transition duration-300">
                            <td class="px-4 py-3 text-sm">{{ $order->id }}</td>
                            <td class="px-4 py-3 text-sm">{{ $order->nama_material ?? 'Material Tidak Ditemukan' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $order->nama_pemasok ?? 'Pemasok Tidak Ditemukan' }}</td>
                            <td class="px-4 py-3 text-sm">Rp {{ number_format($order->harga_satuan, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $order->jumlah_order ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">
                                {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d-m-Y') ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $order->keterangan ?? 'Tidak Ada Keterangan' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex justify-center">
            {{ $orders->links('vendor.pagination.custom-pagination') }} <!-- Pastikan menggunakan $orders untuk pagination -->
        </div>
    </div>
</body>
</html>
@endsection
