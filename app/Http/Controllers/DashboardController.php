<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'total_barang' => Barang::count(),
            'total_kategori' => Kategori::count(),
        ]);
    }
}
