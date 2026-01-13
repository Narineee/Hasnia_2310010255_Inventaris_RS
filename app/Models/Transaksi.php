<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis'; // opsional tapi aman

    protected $fillable = [
        'barang_id',
        'pengguna_id',
        'jenis_transaksi',
        'jumlah',
        'keterangan',
        'tanggal',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
