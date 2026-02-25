<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class KuotaPendaftaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kuota_pendaftaran';

    protected $fillable = [
        'id_bidang',
        'id_periode',
        'jumlah_kuota'
    ];

   

    public function periode()
    {
        return $this->hasMany(Periode::class);
    }

    public function bidang()
    {
        return $this->hasMany(Bidang::class);
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
