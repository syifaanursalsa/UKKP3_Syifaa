@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-4">
        <h5 class="mb-1">Selamat datang, {{ auth()->user()->nama }}</h5>
        <p class="text-muted mb-0">Ringkasan data sistem pengaduan.</p>
    </div>

    {{-- Kartu Statistik --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-people-fill fs-2 text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total User</h6>
                            <h3 class="mb-0 fw-bold">{{ $totalUser }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-person-check-fill fs-2 text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Customer</h6>
                            <h3 class="mb-0 fw-bold">{{ $totalCustomer }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-megaphone-fill fs-2 text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Pengaduan</h6>
                            <h3 class="mb-0 fw-bold">{{ $totalPengaduan }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Akses Cepat --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h6 class="mb-0">Akses Cepat</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary w-100 py-3">
                        <i class="bi bi-people d-block fs-3 mb-2"></i>
                        <span class="fw-semibold">Kelola User</span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-info w-100 py-3">
                        <i class="bi bi-tags d-block fs-3 mb-2"></i>
                        <span class="fw-semibold">Kelola Kategori</span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('kelola.pengaduan') }}" class="btn btn-outline-success w-100 py-3">
                        <i class="bi bi-clipboard-data d-block fs-3 mb-2"></i>
                        <span class="fw-semibold">Kelola Pengaduan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection