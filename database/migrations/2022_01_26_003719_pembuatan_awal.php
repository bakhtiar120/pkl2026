<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PembuatanAwal extends Migration
{
    /**
     * Menjalankan Migrastion dan pembuatan tabel database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('picture')->nullable();
            $table->string('email')->unique();
            $table->boolean('role')->nullable();
            $table->string('status_user')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('profil_member', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nama_lengkap')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('nim')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin',['Laki Laki','Perempuan'])->default('Laki Laki');
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nomor_handphone')->nullable();
            $table->string('nama_dosen_pembimbing')->nullable();
            $table->enum('jenis_kelamin_dosen_pembimbing',['Laki Laki','Perempuan'])->default('Laki Laki');
            $table->string('email_dosen_pembimbing')->nullable();;
            $table->string('nomor_handphone_dosen_pembimbing')->nullable();;
            $table->string('nama_perguruan_tinggi')->nullable();
            $table->text('alamat_perguruan_tinggi')->nullable();
            $table->string('bekas_syarat_pendaftaran')->nullable();
            $table->string('berkas_pas_foto')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('kota_universitas')->nullable();

            $table->string('file_sertifikat')->nullable();

            $table->string('penugasan_laporan_akhir')->nullable();
            $table->string('penugasan_paper')->nullable();
            $table->string('penugasan_poster')->nullable();
            $table->string('penugasan_ringkasan_bidang_mentor')->nullable();
            $table->string('penugasan_vidio_budaya_perusahaan')->nullable();

            $table->integer('skor_integritas')->nullable();
            $table->integer('skor_pengembagan_diri')->nullable();
            $table->integer('skor_kreatifitas')->nullable();
            $table->integer('skor_komunikasi')->nullable();
            $table->integer('skor_analisis')->nullable();
            $table->integer('skor_kerja_sama')->nullable();
            $table->integer('skor_pemahaman')->nullable();
            $table->integer('skor_presentasi')->nullable();



            $table->unsignedBigInteger('user_id'); // Kolom foreign key
            $table->unsignedBigInteger('id_profil_mentor')->nullable(); // Kolom foreign key

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('id_kuota');// Kolom foreign key
            $table->unsignedBigInteger('id_profil');// Kolom foreign key
            $table->enum('status_pendaftaran',['Belum Verifikasi','Lolos','Tidak Lolos','Proses','Selesai'])->default('Proses');
            $table->timestamps();
            $table->softDeletes();

        });
        Schema::create('password_token', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('email')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('kuota_pendaftaran', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('id_bidang');// Kolom foreign key
            $table->unsignedBigInteger('id_periode');// Kolom foreign key
            $table->integer('jumlah_kuota');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bidang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nama_bidang');
            $table->text('deskripsi')->nullable();
            $table->string('icon')->nullable();
            $table->string('jurusan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('periode', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('tgl_mulai_pendaftaran');
            $table->date('tgl_selesai_pendaftaran');
            $table->date('tgl_mulai_pelaksanaan');
            $table->date('tgl_selesai_pelaksanaan');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('profil_mentor', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('jabatan')->nullable();
            $table->unsignedBigInteger('user_id'); // Kolom foreign key
            $table->unsignedBigInteger('id_bidang'); // Kolom foreign key
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('penugasan_tambahan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nama')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('catatan')->nullable();
            $table->string('status')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('id_profil'); // Kolom foreign key
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('artikel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('judul')->nullable();
            $table->string('image')->nullable();
            $table->text('isi')->nullable();
            $table->unsignedBigInteger('user_id'); // Kolom foreign key
            $table->timestamps();
            $table->softDeletes();
        });

        /**
         * Update relasi Database. . .
         *
         * @return void
         */

        Schema::table('artikel', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('penugasan_tambahan', function (Blueprint $table) {
            $table->foreign('id_profil')->references('id')->on('profil_member')->onDelete('cascade');
        });

        Schema::table('profil_member', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_profil_mentor')->references('id')->on('profil_mentor');
        });
        Schema::table('profil_mentor', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->foreign('id_kuota')->references('id')->on('kuota_pendaftaran')->onDelete('cascade');
            $table->foreign('id_profil')->references('id')->on('profil_member')->onDelete('cascade');
        });

        Schema::table('kuota_pendaftaran', function (Blueprint $table) {
            $table->foreign('id_bidang')->references('id')->on('bidang')->onDelete('cascade');
            $table->foreign('id_periode')->references('id')->on('periode')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('profil_member');
        Schema::dropIfExists('pendaftaran');
        Schema::dropIfExists('kuota_pendaftaran');
        Schema::dropIfExists('periode');
        Schema::dropIfExists('profil_mentor');
        Schema::dropIfExists('penugasan_tambahan');
        Schema::dropIfExists('artikel');
        Schema::dropIfExists('password_token');
    }
}
