<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitBidang extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
    public function pendaftarans()
{
    return $this->hasMany(Pendaftaran::class, 'id_unit_kerja');
}
}