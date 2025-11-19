@extends('layouts.app')

@section('content')
<div class="container mt-4" style="padding-top: 80px;"> <!-- jarak dari navbar -->

    <h2 class="mb-4 text-pink fw-bold">Edit Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}"
          method="POST" class="card p-4 shadow-sm">

        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" 
                   value="{{ $barang->nama_barang }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" 
                   value="{{ $barang->stok }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Satuan</label>
            <input type="text" name="satuan"
                   value="{{ $barang->satuan }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori_id" class="form-select bg-pink text-white" required>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}"
                    {{ $kategori->id == $barang->kategori_id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex gap-2"> <!-- memberi jarak antar tombol -->
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i> Update
            </button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Batal
            </a>
        </div>

    </form>

</div>

{{-- Custom CSS --}}
<style>
    .text-pink { color: #e75480 !important; }
    .bg-pink { background-color: #e75480 !important; }
    .form-select.bg-pink option { background-color: #fff; color: #000; } /* agar option terbaca */
</style>

{{-- Font Awesome --}}
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection
