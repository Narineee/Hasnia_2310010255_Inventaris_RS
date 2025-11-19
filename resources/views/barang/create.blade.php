@extends('layouts.app')

@section('content')
<div class="container mt-4" style="padding-top: 80px;"> <!-- jarak dari navbar -->

    <h2 class="mb-4 text-pink fw-bold">Tambah Barang</h2>

    <form action="{{ route('barang.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select class="form-select bg-pink text-white" name="kategori_id" required>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Simpan
            </button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
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
