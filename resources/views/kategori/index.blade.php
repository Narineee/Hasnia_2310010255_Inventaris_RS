@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold text-primary mb-0">Data Kategori</h4>
                <small class="text-muted">Daftar kategori barang</small>
            </div>
            <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                <i class='bx bx-plus'></i> Tambah Kategori
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $kategori)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td class="text-center">
                                <a href="{{ route('kategori.edit', $kategori->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class='bx bx-edit'></i>
                                </a>

                                <form action="{{ route('kategori.destroy', $kategori->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada data kategori
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
