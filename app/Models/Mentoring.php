<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mentoring extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mentoring';

    protected $fillable = [
        'id',
        'id_profil_mentor', 
        'id_profil_member', 
    ];

   

    public function profil_mentor()
    {
        return $this->belongsTo(ProfilMentor::class);
    } 

    public function profil_member()
    {
        return $this->belongsTo(ProfilMember::class);
    }
}
