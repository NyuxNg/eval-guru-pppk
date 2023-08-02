<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldWilayahToTablePPPK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('PPPK', function (Blueprint $table) {
            $table->string('wilayah', 100)->default('Belum diset');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('PPPK', function (Blueprint $table) {
            $table->dropColumn('wilayah');
        });
    }
}
