@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Edit Kategori</h2>

    <form action="{{ route('kategori.update', $kategori->id) }}" 
          method="POST" class="card p-4 shadow-sm">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" 
                   value="{{ $kategori->nama_kategori }}" 
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
