@extends('layouts.app')

@section('title', 'Material')
@section('custom-css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('navbar', 'Dashboard')
@section('navbar-item', 'Supplier')

@section('content')

<div class="row g-3 mt-4">
    <!-- Kolom Pengiriman dengan Ikon -->
    <div class="col-md-4">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body text-center">
                <i class="fas fa-shipping-fast fa-3x text-info mb-3"></i>
                <p class="card-text fs-1 fw-bold">{{ $totalPengiriman }}</p>
                <p class="text-muted">Pengiriman</p>
            </div>
        </div>
    </div>

    <!-- Kolom Material dengan Ikon -->
    <div class="col-md-4">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body text-center">
                <i class="fas fa-box fa-3x text-warning mb-3"></i>
                <p class="card-text fs-1 fw-bold">{{ $totalMaterialPemasok }}</p>
                <p class="text-muted">Material</p>
            </div>
        </div>
    </div>

    <!-- Kolom Kontrak dengan Ikon -->
    <div class="col-md-4">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body text-center">
                <i class="fas fa-file-signature fa-3x text-secondary mb-3"></i>
                <p class="card-text fs-1 fw-bold">{{ $totalKontrak }}</p>
                <p class="text-muted">Kontrak</p>
            </div>
        </div>
    </div>
</div>

@endsection
