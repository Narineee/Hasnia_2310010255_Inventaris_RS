<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function transaksi(Request $request)
    {
        $query = Transaksi::with(['barang', 'pengguna']);

        // filter tanggal
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai)
                ->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        // filter jenis transaksi
        if ($request->filled('jenis_transaksi')) {
            $query->where('jenis_transaksi', $request->jenis_transaksi);
        }

        // filter barang
        if ($request->filled('barang_id')) {
            $query->where('barang_id', $request->barang_id);
        }

        $transaksis = $query->latest()->get();

        // summary
        $totalTransaksi = $transaksis->count();

        $totalMasuk = $transaksis
        ->where('jenis_transaksi', 'masuk')
        ->sum('jumlah');
        
        $totalKeluar = $transaksis
        ->where('jenis_transaksi', 'keluar')
        ->sum('jumlah');
        
        $totalUnit = $totalMasuk + $totalKeluar;

        return view('laporan.transaksi', [
            'transaksis'      => $transaksis,
            'barangs'         => Barang::all(),
            'totalTransaksi' => $totalTransaksi,
            'totalMasuk'     => $totalMasuk,
            'totalKeluar'    => $totalKeluar,
            'totalUnit'      => $totalUnit,
        ]);
    }
}