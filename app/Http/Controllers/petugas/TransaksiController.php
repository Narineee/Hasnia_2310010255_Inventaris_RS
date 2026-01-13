<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('petugas.transaksi.index', [
            'barangs' => Barang::with('kategori')->get(),
            'transaksis' => Transaksi::with('barang')
                ->where('pengguna_id', auth()->id())
                ->latest()
                ->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jenis_transaksi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jenis_transaksi === 'keluar' && $barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi ❌');
        }

        // Update stok
        if ($request->jenis_transaksi === 'masuk') {
            $barang->stok += $request->jumlah;
        } else {
            $barang->stok -= $request->jumlah;
        }

        $barang->save();

        Transaksi::create([
            'barang_id' => $barang->id,
            'pengguna_id' => auth()->id(),
            'jenis_transaksi' => $request->jenis_transaksi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'tanggal' => now(),
        ]);

        return back()->with('success', 'Transaksi berhasil disimpan ✅');
    }
}
