@extends('admin.app')
@section('title', 'Daftar Material')
@section('navbar', 'Material Pemasok')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-roboto">
    <div class="container mx-auto px-4">
        <!-- Navbar -->
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex space-x-8">
                    <a href="{{ route('admin.material') }}" class="py-4 px-1 border-b-2 border-black font-medium text-gray-900">
                        Material Pemasok
                    </a>
                    <a href="{{ route('admin.order') }}" class="py-4 px-1 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Order
                    </a>
                </div>
            </div>
        </div>

        <!-- Material List -->
        <div class="mt-6 bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-700 border-r border-gray-300">No</th>
                        <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-700 border-r border-gray-300">Nama Material</th>
                        <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-700 border-r border-gray-300">Stok</th>
                        <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-700 border-r border-gray-300">Harga Satuan</th>
                        <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-700 border-r border-gray-300">Jenis Material</th>
                        <th class="py-3 px-4 text-left uppercase font-semibold text-sm text-gray-700">Pemasok</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 divide-y divide-gray-200">
                    @forelse ($materials as $material)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class="py-4 px-4 text-sm text-gray-700 border-r border-gray-300">{{ $material->id }}</td>
                            <td class="py-4 px-4 text-sm text-gray-700 border-r border-gray-300">{{ $material->nama_material }}</td>
                            <td class="py-4 px-4 text-sm text-gray-700 border-r border-gray-300">{{ $material->stok }} pcs</td>
                            <td class="py-4 px-4 text-sm text-gray-700 border-r border-gray-300">{{ $material->harga_satuan }}</td>
                            <td class="py-4 px-4 text-sm text-gray-700 border-r border-gray-300">{{ $material->jenis_material }}</td>
                            <td class="py-4 px-4 text-sm text-gray-700">{{ $material->pemasok->nama_pemasok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 px-4 text-center text-gray-500">Tidak ada material yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4 flex justify-center">
            {{ $materials->links('vendor.pagination.custom-pagination') }} <!-- Pagination links standar Laravel -->
        </div>

    </div>

</body>
</html>
@endsection
