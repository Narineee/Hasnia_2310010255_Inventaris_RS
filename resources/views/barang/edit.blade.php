@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Edit Barang</h2>

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
            <select name="kategori_id" class="form-select" required>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}"
                    {{ $kategori->id == $barang->kategori_id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
