<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Periode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'periode';

    protected $fillable = [
        'tgl_mulai_pendaftaran',
        'tgl_selesai_pendaftaran',
        'tgl_mulai_pelaksanaan',
        'tgl_selesai_pelaksanaan',
    ];

   

    public function kuota_pendaftaran()
    {
        return $this->belongsTo(KuotaPendaftaran::class);
    } 
}
