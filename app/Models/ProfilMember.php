<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProfilMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profil_member';

    protected $fillable = [
        'id',
        'user_id',
        'id_profil_mentor', 
        'program_studi',
        'fakultas',
        'kota_universitas',
        'nim',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'nomor_handphone',
        'nama_dosen_pembimbing',
        'jenis_kelamin_dosen_pembimbing',
        'email_dosen_pembimbing',
        'nomor_handphone_dosen_pembimbing',
        'nama_perguruan_tinggi',
        'alamat_perguruan_tinggi',
        'bekas_syarat_pendaftaran',
        'berkas_pas_foto',

        'file_sertifikat',

        'penugasan_laporan_akhir',
        'penugasan_paper',
        'penugasan_poster',
        'penugasan_ringkasan_bidang_mentor',
        'penugasan_vidio_budaya_perusahaan',
        'presentasi_akhir_pelaksanaan',

        'skor_integritas',
        'skor_pengembagan_diri',
        'skor_kreatifitas',
        'skor_komunikasi',
        'skor_analisis',
        'skor_kerja_sama',
        'skor_pemahaman',
        'skor_presentasi',
    ];

   

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }
 
    public function penugasan_tambahan()
    {
        return $this->hasOne(PenugasanTambahan::class);
    }
}
