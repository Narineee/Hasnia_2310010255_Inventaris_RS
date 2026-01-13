@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="container">

    {{-- Judul --}}
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="fw-bold text-pink">Dashboard Petugas</h2>
            <p class="text-muted">Ringkasan data inventaris untuk petugas</p>
        </div>
    </div>

    {{-- Kartu Dashboard --}}
    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-pink h-100 card-hover text-white">
                <div class="card-body d-flex align-items-center">
                    <i class='bx bx-log-in-circle bx-lg text-success me-3'></i>
                    <div>
                        <h6 class="mb-0">Barang Masuk</h6>
                        <small class="text-white-50">Input barang masuk</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-purple h-100 card-hover text-white">
                <div class="card-body d-flex align-items-center">
                    <i class='bx bx-log-out-circle bx-lg text-danger me-3'></i>
                    <div>
                        <h6 class="mb-0">Barang Keluar</h6>
                        <small class="text-white-50">Input barang keluar</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-teal h-100 card-hover text-white">
                <div class="card-body d-flex align-items-center">
                    <i class='bx bx-history bx-lg text-primary me-3'></i>
                    <div>
                        <h6 class="mb-0">Riwayat Transaksi</h6>
                        <small class="text-white-50">Lihat histori</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ALERT DINAMIS DI BAWAH KARTU --}}
    @if(!empty($notifications))
        <div class="row mt-4">
            <div class="col">
                @foreach($notifications as $note)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ $note }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>

<style>
.text-pink { color: #e75480 !important; }
.bg-pink { background-color: #e75480 !important; }
.bg-purple { background-color: #6a0dad !important; }
.bg-teal { background-color: #009688 !important; }
.card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.3); transition:0.3s; }
.text-white-50 { color: rgba(255,255,255,0.7) !important; }
</style>
@endsection
