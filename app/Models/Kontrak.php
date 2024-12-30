<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'mulai_kontrak', 'akhir_kontrak', 'status', 'deskripsi', 'keterangan'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
