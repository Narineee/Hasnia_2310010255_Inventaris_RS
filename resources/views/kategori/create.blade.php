@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold text-primary mb-0">Tambah Kategori</h4>
            <small class="text-muted">Form input kategori baru</small>
        </div>
    </div>

    {{-- Form --}}
    <div class="card shadow-sm border-0 col-md-6">
        <div class="card-body">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text"
                           name="nama_kategori"
                           class="form-control"
                           placeholder="Masukkan nama kategori"
                           required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-save'></i> Simpan
                    </button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                        <i class='bx bx-arrow-back'></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
