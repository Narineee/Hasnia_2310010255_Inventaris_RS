@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold text-primary mb-0">Edit Kategori</h4>
            <small class="text-muted">Perbarui data kategori</small>
        </div>
    </div>

    {{-- Form --}}
    <div class="card shadow-sm border-0 col-md-6">
        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text"
                           name="nama_kategori"
                           value="{{ $kategori->nama_kategori }}"
                           class="form-control"
                           required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class='bx bx-edit'></i> Update
                    </button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                        <i class='bx bx-arrow-back'></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
