<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitBidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up(): void
    {
        Schema::create('unit_bidangs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes(); // deleted_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_bidangs');
    }
}