<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::where('pengguna_id', auth()->id())
            ->latest()
            ->get();

        return view('notifikasi.index', compact('notifikasis'));
    }

    public function baca($id)
    {
        $notifikasi = Notifikasi::where('id', $id)
            ->where('pengguna_id', auth()->id())
            ->firstOrFail();

        $notifikasi->update([
            'status_baca' => 'sudah dibaca'
        ]);

        return back();
    }
}