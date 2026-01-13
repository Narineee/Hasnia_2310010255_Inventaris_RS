@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')

    <style>
        /* ==================== PRINT STYLES ==================== */
        @media print {

            /* ================= PAGE SETUP ================= */
            @page {
                size: A4 landscape;
                margin: 15mm;
            }

            /* ================= HIDE SCREEN ELEMENT ================= */
            .navbar,
            .sidebar,
            .screen-only,
            aside {
                display: none !important;
                width: 0 !important;
            }

            /* ================= RESET BODY & HTML ================= */
            html,
            body {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
                overflow: visible !important;
            }

            /* ================= RESET DASHBOARD LAYOUT ================= */
            .app,
            .wrapper,
            .content-wrapper,
            .main-content,
            main,
            .content {
                margin-left: 0 !important;
                padding-left: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            /* ================= PRINT CONTAINER ================= */
            .print-report {
                display: block !important;
                position: relative;
                left: 0;
                top: 0;
            }

            .print-report .container {
                max-width: 100% !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }

            /* ================= PAGE BREAK CONTROL ================= */
            .summary-card,
            tbody tr {
                page-break-inside: avoid;
            }
        }

        /* ==================== SCREEN STYLES ==================== */
        @media screen {
            .print-report {
                display: none;
            }
        }

        /* ==================== CUSTOM STYLES ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .print-report {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .print-report .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .print-report .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .print-report .header h1 {
            font-size: 36px;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .print-report .header p {
            font-size: 16px;
            opacity: 0.95;
            letter-spacing: 0.5px;
        }

        .print-report .summary-cards {
            padding: 40px 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            background: #f8f9fa;
        }

        .print-report .summary-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            padding: 30px;
            border-radius: 15px;
            color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .print-report .summary-card:hover {
            transform: translateY(-5px);
        }

        .print-report .summary-card:nth-child(2) {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .print-report .summary-card:nth-child(3) {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .print-report .summary-card:nth-child(4) {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .print-report .summary-card h3 {
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
        }

        .print-report .summary-card .value {
            font-size: 38px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .print-report .table-section {
            padding: 40px 30px;
        }

        .print-report .table-header {
            margin-bottom: 25px;
        }

        .print-report .table-header h2 {
            font-size: 22px;
            color: #333;
            font-weight: 700;
        }

        .print-report .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .print-report table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .print-report thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .print-report th {
            padding: 18px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .print-report td {
            padding: 16px 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            color: #555;
        }

        .print-report tbody tr:hover {
            background: #f8f9fa;
        }

        .print-report tbody tr:last-child td {
            border-bottom: none;
        }

        .print-report .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .print-report .badge-masuk {
            background: #d1fae5;
            color: #065f46;
        }

        .print-report .badge-keluar {
            background: #fee2e2;
            color: #991b1b;
        }

        .print-report .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #999;
        }

        .print-report .empty-state::before {
            content: "📋";
            font-size: 64px;
            display: block;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .print-report .empty-state p {
            font-size: 16px;
            font-weight: 500;
        }

        /* Responsive untuk screen kecil */
        @media screen and (max-width: 768px) {
            .print-report .summary-cards {
                grid-template-columns: 1fr;
                padding: 20px;
            }

            .print-report .table-section {
                padding: 20px;
            }

            .print-report th,
            .print-report td {
                padding: 10px;
                font-size: 12px;
            }
        }
    </style>

    {{-- ==================== TAMPILAN LAYAR ==================== --}}
    <div class="screen-only">
        {{-- HEADER --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body bg-primary text-white rounded">
                <h4 class="mb-1">
                    <i class="bx bx-file"></i> Laporan Transaksi
                </h4>
                <small>Inventaris Rumah Sakit</small>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">🔍 Filter Laporan</h5>

                <form method="GET" action="{{ route('laporan.transaksi') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control"
                                value="{{ request('tanggal_mulai') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control"
                                value="{{ request('tanggal_selesai') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Jenis Transaksi</label>
                            <select name="jenis_transaksi" class="form-select">
                                <option value="">Semua</option>
                                <option value="masuk" @selected(request('jenis_transaksi') == 'masuk')>Masuk</option>
                                <option value="keluar" @selected(request('jenis_transaksi') == 'keluar')>Keluar</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Barang</label>
                            <select name="barang_id" class="form-select">
                                <option value="">Semua</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}" @selected(request('barang_id') == $barang->id)>
                                        {{ $barang->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-search"></i> Tampilkan
                        </button>
                        <a href="{{ route('laporan.transaksi') }}" class="btn btn-secondary">
                            <i class="bx bx-rotate-left"></i> Reset
                        </a>
                        <button type="button" onclick="window.print()" class="btn btn-success">
                            <i class="bx bx-printer"></i> Cetak
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- RINGKASAN --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-primary text-white">
                    <div class="card-body">
                        <h6 class="opacity-75">Total Transaksi</h6>
                        <h2 class="mb-0">{{ $totalTransaksi }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-success text-white">
                    <div class="card-body">
                        <h6 class="opacity-75">Barang Masuk</h6>
                        <h2 class="mb-0">{{ $totalMasuk }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-danger text-white">
                    <div class="card-body">
                        <h6 class="opacity-75">Barang Keluar</h6>
                        <h2 class="mb-0">{{ $totalKeluar }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-info text-white">
                    <div class="card-body">
                        <h6 class="opacity-75">Total Unit Transaksi</h6>
                        <h2 class="mb-0">{{ $totalUnit }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABEL --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">No</th>
                                <th>Tanggal</th>
                                <th>Barang</th>
                                <th width="100">Jenis</th>
                                <th width="100">Jumlah</th>
                                <th>Petugas</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksis as $i => $trx)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $trx->tanggal->format('d M Y') }}</td>
                                    <td>{{ $trx->barang->nama_barang }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $trx->jenis_transaksi == 'masuk' ? 'success' : 'danger' }}">
                                            {{ ucfirst($trx->jenis_transaksi) }}
                                        </span>
                                    </td>
                                    <td>{{ $trx->jumlah }} unit</td>
                                    <td>{{ $trx->pengguna->name }}</td>
                                    <td>{{ $trx->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <i class="bx bx-info-circle fs-3 d-block mb-2"></i>
                                        Tidak ada data transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== TAMPILAN PRINT ==================== --}}
    <div class="print-report">
        <div class="container">
            {{-- Header --}}
            <div class="header">
                <h1>📊 Laporan Transaksi Inventory</h1>
                <p>Inventaris Rumah Sakit</p>
            </div>

            {{-- Summary Cards --}}
            <div class="summary-cards">
                <div class="summary-card">
                    <h3>Total Transaksi</h3>
                    <div class="value">{{ $totalTransaksi }}</div>
                </div>
                <div class="summary-card">
                    <h3>Barang Masuk</h3>
                    <div class="value">{{ $totalMasuk }}</div>
                </div>
                <div class="summary-card">
                    <h3>Barang Keluar</h3>
                    <div class="value">{{ $totalKeluar }}</div>
                </div>
                <div class="summary-card">
                    <h3>Total Unit Transaksi</h3>
                    <div class="value">{{ $totalUnit }}</div>
                </div>
            </div>

            {{-- Table Section --}}
            <div class="table-section">
                <div class="table-header">
                    <h2>📋 Detail Transaksi</h2>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Petugas</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transaksis as $index => $trx)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $trx->tanggal->format('d M Y') }}</td>
                                    <td>{{ $trx->barang->nama_barang }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $trx->jenis_transaksi === 'masuk' ? 'badge-masuk' : 'badge-keluar' }}">
                                            {{ ucfirst($trx->jenis_transaksi) }}
                                        </span>
                                    </td>
                                    <td>{{ $trx->jumlah }} unit</td>
                                    <td>{{ $trx->pengguna->name }}</td>
                                    <td>{{ $trx->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="empty-state">
                                        <p>Tidak ada data transaksi</p>
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