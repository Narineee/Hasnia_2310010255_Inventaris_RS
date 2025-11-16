@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Data Barang</h2>

    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">
        Tambah Barang
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
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
            <tr>
                <td>{{ $barang->id }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->stok }}</td>
                <td>{{ $barang->satuan }}</td>
                <td>{{ $barang->kategori->nama_kategori }}</td>

                <td>
                    <a href="{{ route('barang.edit', $barang->id) }}"
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('barang.destroy', $barang->id) }}"
                          method="POST" class="d-inline">
                        @csrf @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus barang ini?')">
                            Hapus
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
