@extends('admin.app')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <!-- Tombol Kembali ke Profil -->
        <a href="{{ route('admin.profile.show') }}" class="btn btn-secondary">Kembali ke Profil</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Daftar Pengguna</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Usertype</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{-- Dropdown untuk memilih usertype --}}
                                <form action="{{ url('/admin/users/' . $user->id . '/update') }}" method="POST">
                                    @csrf
                                    <select name="usertype" class="form-select" {{ auth()->id() === $user->id ? 'disabled' : '' }}>
                                        <option value="user" {{ $user->usertype === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->usertype === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                            </td>
                            <td>
                                {{-- Menampilkan aksi --}}
                                @if(auth()->id() === $user->id)
                                    <span class="badge bg-secondary">Tidak dapat diubah</span>
                                @else
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
