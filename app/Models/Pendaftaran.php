<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'id',
        'status_pendaftaran',
        'id_profil',
        'id_kuota',
    ];

   

    public function kuota_pendaftaran()
    {
        return $this->hasMany(KuotaPendaftaran::class);
    } 

    public function profil_member()
    {
        return $this->hasOne(ProfilMember::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitBidang::class, 'id_unit_kerja');
    }
}