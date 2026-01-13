<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Barang;
use App\Models\Pengguna;
use App\Models\Transaksi;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with('barang')
            ->where('pengguna_id', auth()->id());

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

        return view('petugas.transaksi.index', [
            'barangs' => Barang::all(),
            'transaksis' => $query->latest()->get()
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

        // update stok
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

        $admins = Pengguna::where('role', 'admin')->get();

        // 🔔 NOTIFIKASI TRANSAKSI
        foreach ($admins as $admin) {
            Notifikasi::create([
                'pengguna_id' => $admin->id,
                'barang_id' => $barang->id,
                'judul' => 'Transaksi ' . ucfirst($request->jenis_transaksi),
                'pesan' => 'Petugas ' . auth()->user()->name .
                    ' melakukan transaksi ' . $request->jenis_transaksi .
                    ' barang "' . $barang->nama_barang .
                    '" sebanyak ' . $request->jumlah . ' unit.',
                'tipe' => 'informasi',
            ]);
        }
        // 🔔 NOTIFIKASI STOK MENIPIS
        if ($barang->stok <= 5) {
            foreach ($admins as $admin) {
                Notifikasi::create([
                    'pengguna_id' => $admin->id,
                    'barang_id' => $barang->id,
                    'judul' => 'Stok Menipis',
                    'pesan' => 'Stok barang "' . $barang->nama_barang . '" tersisa ' . $barang->stok . ' unit',
                    'tipe' => 'peringatan',
                ]);
            }
        }

        // 🔔 NOTIFIKASI SUKSES
        return redirect()
            ->route('petugas.transaksi.index')
            ->with('success', 'Transaksi berhasil disimpan ✅');
    }
}