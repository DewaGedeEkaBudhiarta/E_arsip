<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_berkas',
        'nama_berkas',
        'user_pengakses',
        'jam_ubah_create',
        'tanggal',
        'status',
        'action',
    ];
}
