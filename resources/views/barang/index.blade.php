@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 text-pink fw-bold">Data Barang</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('barang.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Barang
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-white bg-pink">
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th width="180px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                <tr class="table-hover">
                    <td>{{ $barang->id }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>{{ $barang->satuan }}</td>
                    <td>{{ $barang->kategori->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning me-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('barang.destroy', $barang->id) }}" 
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus barang ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

{{-- Custom CSS --}}
<style>
    .text-pink { color: #e75480 !important; }

    /* Hover Effect untuk baris tabel */
    tbody tr:hover {
        background-color: rgba(231, 84, 128, 0.2);
    }

    /* Tombol tambah dengan icon */
    .btn-primary i {
        vertical-align: middle;
    }

    /* Spasi dari navbar */
    .content-wrapper {
        margin-left: 220px; /* sidebar */
        padding: 20px;
        padding-top: 80px; /* supaya tidak mepet navbar */
        width: 100%;
        transition: margin-left 0.3s;
    }
</style>

{{-- Font Awesome --}}
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection
