<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FileUpload extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'file_upload';

    protected $fillable = [
        'id',
        'nama_file',
        'jenis_file',
        'lokasi_file',
    ];

}
