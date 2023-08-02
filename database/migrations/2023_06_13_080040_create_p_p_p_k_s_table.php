<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePPPKSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pppk', function (Blueprint $table) {
            $table->uuid('idOrang')->primary();
            $table->string('nipBaru', 18)->unique();
            $table->string('nama', 150);
            $table->string('statusPerkawinan', 25);
            $table->string('golru', 3);
            $table->date('tmtPPPK')->default(null);
            $table->string('pendidikan', 150);
            $table->string('jabatanASN', 150);
            $table->string('unitKerja', 150);
            $table->string('linear', 25);
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pppk');
    }
}
