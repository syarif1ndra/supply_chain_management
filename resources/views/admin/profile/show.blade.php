@extends('admin.app')

@section('title', 'Profil')
@section('custom-css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <style>

      .profile-photo {
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 150px;
          border-radius: 50%;
      }
      .profile-card .btn {
          width: 100%;
          margin-top: 10px;
      }
  </style>
@endsection

@section('navbar', 'Profil')
@section('navbar-item', 'Informasi Profil')

@section('content')
    <!-- Content -->
    <div class="card profile-card shadow bg-body-tertiary rounded">
        <div class="card-body text-center">
            @if ($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" class="profile-photo mb-3">
            @else
                <img src="{{ asset('images/default-user.png') }}" alt="Foto Profil Default" class="profile-photo mb-3">
            @endif
            <h5 class="card-title">Nama: {{ $user->name }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>

            <!-- Tombol Edit dan Ganti Password -->
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profil</a>
            <a href="{{ route('admin.profile.change.password') }}" class="btn btn-warning mt-3">Ganti Password</a>
            <a href="{{ route('admin.users') }}" class="btn btn-warning mt-3">Atur Hak Akses</a>

        </div>
    </div>
@endsection
