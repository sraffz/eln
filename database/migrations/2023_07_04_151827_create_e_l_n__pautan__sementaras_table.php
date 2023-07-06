<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateELNPautanSementarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eln_pautan_sementara', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usersID');
            $table->string('jenis_permohonan');
            $table->string('signature');
            $table->string('link');
            $table->dateTime('tempoh_mula');
            $table->dateTime('tempoh_tamat');
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
        Schema::dropIfExists('eln_pautan_sementara');
    }
}
