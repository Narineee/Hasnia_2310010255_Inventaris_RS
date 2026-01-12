@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold text-primary mb-0">Tambah Barang</h4>
            <small class="text-muted">Form input data barang inventaris</small>
        </div>
    </div>

    {{-- Form --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class='bx bx-save'></i> Simpan
                    </button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                        <i class='bx bx-arrow-back'></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
