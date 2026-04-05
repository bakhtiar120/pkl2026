<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitBidang extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status'
    ];
     public function kuota()
    {
        return $this->hasMany(KuotaPendaftaran::class, 'id_unit_bidang');
    }

    public function periode()
    {
        return $this->belongsToMany(
            Periode::class,
            'kuota_pendaftaran',
            'id_unit_bidang',
            'id_periode'
        )->withPivot('id_bidang', 'jumlah_kuota');
    }
}