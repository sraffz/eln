<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElnKelulusansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eln_kelulusan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_pengesahan');
            $table->string('id_pelulus');
            $table->string('jawatan_pelulus');
            $table->string('gred_pelulus');
            $table->string('ulasan');
            $table->string('status_kelulusan');
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
        Schema::dropIfExists('eln_kelulusan');
    }
}
