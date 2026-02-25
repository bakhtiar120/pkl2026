<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Bidang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bidang';

    protected $fillable = [
        'id',
        'nama_bidang',
        'deskripsi',
        'icon',
        'jurusan',
        'status', 
    ];

    public function kuota_pendaftaran()
    {
        return $this->belongsTo(KuotaPendaftaran::class);
    } 
}
