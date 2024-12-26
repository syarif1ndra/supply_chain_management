@extends('admin.app')

@section('title', 'Material')
@section('custom-css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
@section('navbar', 'Dashboard')
@section('navbar-item', 'Admin')

@section('content')
  <div class="row g-4 mt-4">
    <!-- Tambahkan logo disini -->


    <!-- Kartu Proyek Aktif dengan Ikon -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <i class="fas fa-project-diagram fa-3x text-primary mb-3"></i>
          <h1 class="text-dark fw-bold">{{ $totalProyek }}</h1>
          <p class="fs-5 text-muted">Proyek Aktif</p>
        </div>
      </div>
    </div>

    <!-- Kartu Pemasok dengan Ikon -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <i class="fas fa-truck fa-3x text-success mb-3"></i>
          <h1 class="text-dark fw-bold">{{ $totalPemasok }}</h1>
          <p class="fs-5 text-muted">Pemasok</p>
        </div>
      </div>
    </div>

    <!-- Kartu Material Pemasok dengan Ikon -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <i class="fas fa-box fa-3x text-warning mb-3"></i>
          <h1 class="text-dark fw-bold">{{ $totalMaterialPemasok }}</h1>
          <p class="fs-5 text-muted">Material Pemasok</p>
        </div>
      </div>
    </div>

    <!-- Kartu Material Proyek dengan Ikon -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <i class="fas fa-cogs fa-3x text-danger mb-3"></i>
          <h1 class="text-dark fw-bold">{{ $totalMaterialProyek }}</h1>
          <p class="fs-5 text-muted">Material Proyek</p>
        </div>
      </div>
    </div>

    <!-- Kartu Pengiriman dengan Ikon -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <i class="fas fa-shipping-fast fa-3x text-info mb-3"></i>
          <h1 class="text-dark fw-bold">{{ $totalPengiriman }}</h1>
          <p class="fs-5 text-muted">Pengiriman</p>
        </div>
      </div>
    </div>

    <!-- Kartu Kontrak dengan Ikon -->
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <i class="fas fa-file-signature fa-3x text-secondary mb-3"></i>
          <h1 class="text-dark fw-bold">{{ $totalKontrak }}</h1>
          <p class="fs-5 text-muted">Kontrak</p>
        </div>
      </div>
    </div>
  </div>
@endsection
