@extends('admin.app')
@section('title', 'Pemasok')
@section('navbar', 'Pemasok')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pemasok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="bg-gray-100">
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-start space-x-8 border-b-2 border-gray-200">
                <a href="{{ route('admin.pemasok') }}" class="py-4 px-1 border-b-2 border-black font-medium text-gray-900">Pemasok</a>
                <a href="{{ route('admin.kontrak.home') }}" class="py-4 px-1 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Kontrak</a>
            </div>
        </div>
    </div>
    <div class="container mx-auto my-4">

        <!-- Tombol untuk menambahkan pemasok -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('admin.pemasok.create') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>Tambah Pemasok
            </a>
        </div>

        <!-- Daftar Pemasok -->
        <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white border-collapse border border-gray-300">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-sm border-r border-b border-gray-300">No</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm border-r border-b border-gray-300">Nama Pemasok</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm border-r border-b border-gray-300">Alamat</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm border-r border-b border-gray-300">Kontak</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm border-r border-b border-gray-300">Nama Kontrak</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm border-r border-b border-gray-300">Rating Pemasok</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm border-r border-b border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($pemasok as $key => $data)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class="py-3 px-4 text-center border-r border-gray-300">{{ $loop->iteration + ($pemasok->currentPage() - 1) * $pemasok->perPage() }}</td>
                            <td class="py-3 px-4 text-center border-r border-gray-300">{{ $data->nama_pemasok }}</td>
                            <td class="py-3 px-4 text-center border-r border-gray-300">{{ $data->alamat }}</td>
                            <td class="py-3 px-4 text-center border-r border-gray-300">{{ $data->kontak }}</td>
                            <td class="py-3 px-4 text-center border-r border-gray-300">{{ $data->kontrak->deskripsi ?? 'Tidak Ada Kontrak' }}</td>
                            <td class="py-3 px-4 text-center border-r border-gray-300">{{ $data->rating_pemasok }}</td>
                            <td class="py-3 px-4 flex justify-center items-center space-x-2 border-gray-300">
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.pemasok.edit', $data->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg text-sm shadow-md transition duration-300">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.pemasok.destroy', $data->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-lg text-sm shadow-md transition duration-300">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Navigasi Pagination -->
        <div class="mt-4 flex justify-center">
            {{ $pemasok->links('vendor.pagination.custom-pagination') }}
        </div>


    </div>
</body>
</html>
@endsection
