@extends('admin.app')

@section('title', 'Material')
@section('custom-css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('navbar', 'Dashboard')
@section('navbar-item', 'Admin')

@section('content')
  <div class="row g-4 mt-4">
    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <h1 class="text-dark fw-bold">{{ $totalProyek }}</h1>
          <p class="fs-5 text-muted">Proyek Aktif</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <h1 class="text-dark fw-bold">{{ $totalPemasok }}</h1>
          <p class="fs-5 text-muted">Pemasok</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <h1 class="text-dark fw-bold">{{ $totalMaterialPemasok }}</h1>
          <p class="fs-5 text-muted">Material Pemasok</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <h1 class="text-dark fw-bold">{{ $totalMaterialProyek }}</h1>
          <p class="fs-5 text-muted">Material Proyek</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <h1 class="text-dark fw-bold">{{ $totalPengiriman }}</h1>
          <p class="fs-5 text-muted">Pengiriman</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card shadow-sm border-light rounded-3 h-100" style="background-color: #ffffff;">
        <div class="card-body text-center">
          <h1 class="text-dark fw-bold">{{ $totalKontrak }}</h1>
          <p class="fs-5 text-muted">Kontrak</p>
        </div>
      </div>
    </div>
  </div>
@endsection
