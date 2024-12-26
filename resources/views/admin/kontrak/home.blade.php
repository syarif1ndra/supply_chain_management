@extends('admin.app')
@section('title', 'Kontrak')
@section('navbar', 'Kontrak')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kontrak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto">
        <div class="bg-gray-100 mb-4">
            <div class="max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex justify-start space-x-8 border-b-2 border-gray-200">
                    <a href="{{ route('admin.pemasok') }}" class="py-4 px-1 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Pemasok</a>
                    <a href="{{ route('admin.kontrak.home') }}" class="py-4 px-1 border-b-2 border-black font-medium text-gray-900">Kontrak</a>
                </div>
            </div>
        </div>
        <!-- Tombol untuk menambahkan kontrak -->
        <div class="mb-3 flex justify-between items-center">
            <a href="{{ route('admin.kontrak.create') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>Tambah Kontrak
            </a>
        </div>

        <!-- Daftar Kontrak -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white border-collapse border border-gray-300">
                <thead class="bg-gray-100 border-b border-gray-300">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-800 border-r border-gray-300">No</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-800 border-r border-gray-300">Tanggal Mulai</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-800 border-r border-gray-300">Tanggal Selesai</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-800 border-r border-gray-300">Deskripsi</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-800 border-r border-gray-300">Bukti Kontrak</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @forelse ($kontrak as $kontrakItem)
                        <tr class="border-b border-gray-300 hover:bg-gray-50 transition duration-300">
                            <td class="py-3 px-4 text-center border-r border-gray-300">{{ $kontrakItem->id }}</td>
                            <td class="py-3 px-4 text-center border-r border-gray-300">{{ \Carbon\Carbon::parse($kontrakItem->tanggal_mulai)->format('d M Y') }}</td>
                            <td class="py-3 px-4 text-center border-r border-gray-300">{{ \Carbon\Carbon::parse($kontrakItem->tanggal_selesai)->format('d M Y') }}</td>
                            <td class="py-3 px-4 border-r border-gray-300">{{ $kontrakItem->deskripsi }}</td>
                            <td class="py-3 px-4 text-center border-r border-gray-300">
                                <a href="{{ asset('storage/' . $kontrakItem->bukti_kontrak) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a>
                            </td>
                            <td class="py-3 px-4 flex justify-center space-x-2">
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.kontrak.edit', $kontrakItem->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-sm shadow-md transition duration-300">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.kontrak.destroy', $kontrakItem->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm shadow-md transition duration-300">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-3 px-4 text-center text-gray-500">Tidak ada data kontrak yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4 flex justify-center">
            {{ $kontrak->links('vendor.pagination.custom-pagination') }} <!-- Pagination links standar Laravel -->
        </div>

    </div>
</body>
</html>
@endsection
