<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElnPengesahanBahagiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eln_pengesahan_bahagian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_permohonan');
            $table->string('id_pemohon');
            $table->string('jawatan_pemohon');
            $table->string('gred_pemohon');
            $table->string('jabatan_pemohon');
            $table->string('id_pengesah');
            $table->string('jawatan_pengesah');
            $table->string('gred_pengesah');
            $table->string('jabatan_pengesah');
            $table->string('ulasan');
            $table->string('status_pengesah');
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
        Schema::dropIfExists('eln_pengesahan_bahagian');
    }
}
