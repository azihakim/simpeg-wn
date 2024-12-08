<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromosiDemosi extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_karyawan',
        'surat_rekomendasi',
        'divisi_lama',
        'divisi_baru',
        'status',
        'jenis'
    ];

    function karyawan()
    {
        return $this->belongsTo(User::class, 'id_karyawan');
    }
}
