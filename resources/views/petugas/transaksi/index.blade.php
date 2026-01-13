@extends('layouts.app')

@section('title', 'Transaksi Barang')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold text-primary mb-0">Transaksi Barang</h4>
            <small class="text-muted">Barang masuk & keluar</small>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Form --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('petugas.transaksi.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Barang</label>
                        <select name="barang_id" class="form-select" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">
                                    {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Jenis</label>
                        <select name="jenis_transaksi" class="form-select" required>
                            <option value="masuk">Barang Masuk</option>
                            <option value="keluar">Barang Keluar</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button class="btn btn-primary">
                        <i class='bx bx-save'></i> Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
    <form method="GET" class="row g-2 mb-3">

    <div class="col-md-3">
        <input type="date" name="tanggal_mulai" class="form-control"
            value="{{ request('tanggal_mulai') }}">
    </div>

    <div class="col-md-3">
        <input type="date" name="tanggal_selesai" class="form-control"
            value="{{ request('tanggal_selesai') }}">
    </div>

    <div class="col-md-2">
        <select name="jenis_transaksi" class="form-select">
            <option value="">-- Semua Jenis --</option>
            <option value="masuk" {{ request('jenis_transaksi')=='masuk'?'selected':'' }}>Masuk</option>
            <option value="keluar" {{ request('jenis_transaksi')=='keluar'?'selected':'' }}>Keluar</option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="barang_id" class="form-select">
            <option value="">-- Semua Barang --</option>
            @foreach($barangs as $barang)
                <option value="{{ $barang->id }}"
                    {{ request('barang_id')==$barang->id?'selected':'' }}>
                    {{ $barang->nama_barang }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-1 d-grid">
        <button class="btn btn-primary">
            <i class='bx bx-filter'></i>
        </button>
    </div>

</form>

    {{-- Riwayat --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h6 class="fw-bold mb-3">Riwayat Transaksi Saya</h6>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $trx)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trx->tanggal }}</td>
                            <td>{{ $trx->barang->nama_barang }}</td>
                            <td>
                                <span class="badge {{ $trx->jenis_transaksi == 'masuk' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($trx->jenis_transaksi) }}
                                </span>
                            </td>
                            <td>{{ $trx->jumlah }}</td>
                            <td>{{ $trx->keterangan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada transaksi
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