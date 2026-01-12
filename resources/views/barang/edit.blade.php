@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold text-primary mb-0">Edit Barang</h4>
            <small class="text-muted">Ubah data barang inventaris</small>
        </div>
    </div>

    {{-- Form --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang"
                               value="{{ $barang->nama_barang }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="satuan"
                               value="{{ $barang->satuan }}"
                               class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok"
                               value="{{ $barang->stok }}"
                               class="form-control" required>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-warning">
                        <i class='bx bx-edit'></i> Update
                    </button>
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                        <i class='bx bx-arrow-back'></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
