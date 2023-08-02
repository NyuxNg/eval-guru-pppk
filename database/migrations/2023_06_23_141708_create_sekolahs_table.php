<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->string('npsn', 9)->primary();
            $table->string('namadapodik', 100)->nullable();
            $table->string('namasekolah', 100)->nullable();
            $table->string('jenjang', 10)->nullable()->default('SD');
            $table->string('wilayah', 100)->nullable();
            $table->integer('siswa')->unsigned()->nullable();
            $table->integer('abk')->unsigned()->nullable();
            $table->integer('rombel')->unsigned()->nullable();
            $table->integer('asn')->unsigned()->nullable();
            $table->integer('nonASN')->unsigned()->nullable();
            $table->text('catatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sekolah');
    }
}
