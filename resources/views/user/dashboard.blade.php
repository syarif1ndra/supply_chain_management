@extends('layouts.app')

@section('title', 'Material')
@section('custom-css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('navbar', 'Dashboard')
@section('navbar-item', 'Supplier')

@section('content')

<div class="row g-3 mt-4">
    <!-- Kolom Pengiriman -->
    <div class="col-md-4">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body">
                <p class="card-text text-center fs-1 fw-bold">{{ $totalPengiriman }}</p>
                <p class="text-center text-muted">Pengiriman</p>
            </div>
        </div>
    </div>
    <!-- Kolom Material -->
    <div class="col-md-4">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body">
                <p class="card-text text-center fs-1 fw-bold">{{ $totalMaterialPemasok }}</p>
                <p class="text-center text-muted">Material</p>
            </div>
        </div>
    </div>
    <!-- Kolom Kontrak -->
    <div class="col-md-4">
        <div class="card shadow-sm rounded-lg">
            <div class="card-body">
                <p class="card-text text-center fs-1 fw-bold">{{ $totalKontrak }}</p>
                <p class="text-center text-muted">Kontrak</p>
            </div>
        </div>
    </div>
</div>

@endsection
