<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Artikel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'artikel';

    protected $fillable = [
        'id',         
        'user_id',
        'judul', 
        'isi', 
    ];

   

    public function user()
    {
        return $this->belongsTo(Users::class);
    }  
}
