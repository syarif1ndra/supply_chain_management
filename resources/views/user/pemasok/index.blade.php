@extends('layouts.app')
@section('navbar', 'Pemasok')
@section('title', 'Daftar Pemasok')

@section('content')

<a href="{{ route('user.pemasok.create') }}" class="btn bg-gray-500 hover:bg-gray-700 text-white mb-3">Tambah Pemasok</a>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-200 text-black">
            <tr class="divide-x divide-gray-200">
                <th class="py-3 px-4 uppercase font-semibold text-sm rounded-ss-lg">Nama Pemasok</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm">Alamat</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm">Kontak</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm">Kontrak</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm">Rating</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm rounded-se-lg">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($pemasok as $item)
                <tr class="divide-x divide-gray-200 hover:bg-gray-100 transition duration-300">
                    <td class="py-3 px-4">{{ $item->nama_pemasok }}</td>
                    <td class="py-3 px-4">{{ $item->alamat }}</td>
                    <td class="py-3 px-4">{{ $item->kontak }}</td>
                    <td class="py-3 px-4">{{ $item->kontrak ? $item->kontrak->deskripsi : '-' }}</td>
                    <td class="py-3 px-4">{{ $item->rating_pemasok }}</td>
                    <td class="py-3 px-4 flex space-x-2">
                        <!-- Aksi Edit dan Hapus -->
                        <a href="{{ route('user.pemasok.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-sm shadow-md transition duration-300" aria-label="Edit Pemasok">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('user.pemasok.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemasok ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm shadow-md transition duration-300" aria-label="Hapus Pemasok">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination Controls -->
<div class="mt-4 flex justify-center">
    {{ $pemasok->links('vendor.pagination.custom-pagination') }} <!-- This renders the pagination links -->
</div>

@endsection
