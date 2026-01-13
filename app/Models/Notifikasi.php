<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = [
        'pengguna_id',
        'barang_id',
        'judul',
        'pesan',
        'tipe',
        'status_baca',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}