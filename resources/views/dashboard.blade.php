@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="fw-bold text-pink">Dashboard Inventaris</h2>
            <p class="text-muted">Ringkasan data inventaris rumah sakit</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">

        <!-- Total Barang -->
        <div class="col-md-5">
            <a href="{{ route('barang.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 text-white bg-pink h-100 card-hover">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title">Total Barang</h5>
                            <h2>{{ $total_barang }}</h2>
                        </div>
                        <div class="icon-wrapper">
                            <i class='bx bx-box bx-lg'></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Kategori -->
        <div class="col-md-5">
            <a href="{{ route('kategori.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 text-white bg-purple h-100 card-hover">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title">Total Kategori</h5>
                            <h2>{{ $total_kategori }}</h2>
                        </div>
                        <div class="icon-wrapper">
                            <i class='bx bx-category bx-lg'></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

<style>
.text-pink { color: #e75480 !important; }
.bg-pink { background-color: #e75480 !important; }
.bg-purple { background-color: #6a0dad !important; }
.icon-wrapper { opacity:0.8; transition: transform 0.3s; }
.card-hover:hover .icon-wrapper { transform: scale(1.2); opacity:1; }
</style>
@endsection
