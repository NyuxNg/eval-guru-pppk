<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTktPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tkt_pendidikans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode', 3);
            $table->string('nama', 25);
            $table->string('golAwal', 2);
            $table->string('golAkhir', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tkt_pendidikans');
    }
}
