<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitBidangToKuotaPendaftaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kuota_pendaftaran', function (Blueprint $table) {
    $table->unsignedBigInteger('id_unit_bidang')
          ->nullable()
          ->after('id_periode');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kuota_pendaftaran', function (Blueprint $table) {
            //
        });
    }
}