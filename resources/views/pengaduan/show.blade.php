@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('pengaduan.index') }}" class="btn btn-sm btn-outline-secondary me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h5 class="mb-0">Detail Pengaduan</h5>
    </div>

    <div class="card border-0 shadow-sm" style="max-width: 700px;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted small">{{ $pengaduan->created_at->format('d M Y') }}</span>
                @php
                    $badge = [
                        'menunggu' => 'text-bg-warning',
                        'diproses' => 'text-bg-primary',
                        'selesai' => 'text-bg-success',
                    ][$pengaduan->status] ?? 'text-bg-secondary';
                @endphp
                <span class="badge {{ $badge }}">{{ ucfirst($pengaduan->status) }}</span>
            </div>

            <p>{{ $pengaduan->pengaduan }}</p>

           {{-- Tampilkan foto bukti jika ada --}}
@if ($pengaduan->foto)
    <div class="mb-3">
        <label class="form-label fw-bold">Foto Bukti:</label>
        <br>
        <img src="{{ asset('storage/' . $pengaduan->foto) }}"
             class="img-fluid rounded" 
             style="max-height: 300px; border: 2px solid #ddd;" 
             alt="Foto bukti"
             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22%3E%3Crect fill=%22%23ddd%22 width=%22200%22 height=%22200%22/%3E%3Ctext fill=%22%23999%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3EGagal memuat foto%3C/text%3E%3C/svg%3E';">
        <br>
        <small class="text-muted">
            Path: {{ $pengaduan->foto }}<br>
            URL: {{ asset('storage/' . $pengaduan->foto) }}
        </small>
    </div>
@else
    <p class="text-muted">Tidak ada foto bukti.</p>
@endif
        </div>
    </div>
@endsection