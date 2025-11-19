@extends('layouts.app')

@section('content')
<div class="container mt-4" style="padding-top: 80px;"> <!-- jarak dari navbar -->

    <h2 class="mb-4 text-pink fw-bold">Tambah Kategori</h2>

    <form action="{{ route('kategori.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control bg-pink text-white" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Simpan
            </button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </form>

</div>

{{-- Custom CSS --}}
<style>
    .text-pink { color: #e75480 !important; }
    .bg-pink { background-color: #e75480 !important; }
</style>

{{-- Font Awesome --}}
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection
