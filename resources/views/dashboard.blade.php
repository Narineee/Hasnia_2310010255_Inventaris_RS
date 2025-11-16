@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-4">
        <div class="col">
            <h2>Dashboard Inventaris</h2>
            <p class="text-muted">Ringkasan data inventaris rumah sakit</p>
        </div>
    </div>

    <div class="row">

        <!-- Kartu Total Barang -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <h2>{{ $total_barang }}</h2>
                </div>
            </div>
        </div>

        <!-- Kartu Total Kategori -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Kategori</h5>
                    <h2>{{ $total_kategori }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
