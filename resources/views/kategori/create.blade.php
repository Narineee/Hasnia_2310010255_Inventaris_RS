@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Tambah Kategori</h2>

    <form action="{{ route('kategori.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
