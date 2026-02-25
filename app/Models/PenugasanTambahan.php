<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PenugasanTambahan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penugasan_tambahan';

    protected $fillable = [
        'id',
        'nama',
        'deskripsi',
        'catatan',
        'status',
        'file',
        'id_profil',
    ];

   

    public function profil_member()
    {
        return $this->belongsTo(ProfilMember::class);
    }  
}
