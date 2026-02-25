<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilMentor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profil_mentor';

    protected $fillable = [
        'id',
        'nama',
        'nip',
        'jabatan', 
        'user_id',
        'id_bidang',
    ];

   

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profil_member()
    {
        return $this->belongsTo(ProfilMember::class);
    } 
}
