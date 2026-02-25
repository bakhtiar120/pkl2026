<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailOtpsTable extends Migration
{
    /**
     * Menjalankan Migrastion dan pembuatan tabel database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_otps', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('otp');
    $table->timestamp('expires_at');
    $table->unsignedTinyInteger('attempts')->default(0);
    $table->timestamp('last_sent_at')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_otps');
    }
}