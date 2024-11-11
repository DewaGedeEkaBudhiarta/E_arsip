<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiArsip extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'klasifikasi_arsip';

    // Specify the fillable properties if needed
    protected $fillable = [
        'Fungsi',
        'Primer',
        'Kegiatan',
        'Sekunder',
        'Transaksi',
        'Tersier',
        'Indeks'
    ];
}
