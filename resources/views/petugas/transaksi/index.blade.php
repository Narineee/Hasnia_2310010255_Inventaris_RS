@extends('layouts.app')
@section('title', 'Transaksi Barang')

@section('content')
<div class="container-fluid">

<h4 class="fw-bold text-primary mb-3">Transaksi Barang</h4>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

{{-- FORM --}}
<div class="card mb-4 shadow-sm">
<div class="card-body">
<form action="{{ route('petugas.transaksi.store') }}" method="POST">
@csrf
<div class="row">
<div class="col-md-4">
<label>Barang</label>
<select name="barang_id" class="form-select" required>
<option value="">-- Pilih Barang --</option>
@foreach($barangs as $barang)
<option value="{{ $barang->id }}">
{{ $barang->nama_barang }} ({{ $barang->stok }} {{ $barang->satuan }})
</option>
@endforeach
</select>
</div>

<div class="col-md-3">
<label>Jenis</label>
<select name="jenis_transaksi" class="form-select" required>
<option value="masuk">Barang Masuk</option>
<option value="keluar">Barang Keluar</option>
</select>
</div>

<div class="col-md-2">
<label>Jumlah</label>
<input type="number" name="jumlah" class="form-control" min="1" required>
</div>

<div class="col-md-3">
<label>Keterangan</label>
<input type="text" name="keterangan" class="form-control">
</div>
</div>

<button class="btn btn-primary mt-3">
<i class="bx bx-save"></i> Simpan
</button>
</form>
</div>
</div>

{{-- RIWAYAT --}}
<div class="card shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Riwayat Transaksi</h6>

<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
<th>No</th>
<th>Barang</th>
<th>Jenis</th>
<th>Jumlah</th>
<th>Tanggal</th>
</tr>
</thead>
<tbody>
@forelse($transaksis as $t)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $t->barang->nama_barang }}</td>
<td>
<span class="badge {{ $t->jenis_transaksi == 'masuk' ? 'bg-success' : 'bg-danger' }}">
{{ ucfirst($t->jenis_transaksi) }}
</span>
</td>
<td>{{ $t->jumlah }}</td>
<td>{{ $t->tanggal }}</td>
</tr>
@empty
<tr>
<td colspan="5" class="text-center text-muted">Belum ada transaksi</td>
</tr>
@endforelse
</tbody>
</table>

</div>
</div>

</div>
@endsection
