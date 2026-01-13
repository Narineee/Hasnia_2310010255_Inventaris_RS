<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class StokController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('petugas.stok', compact('barangs'));
    }
}
