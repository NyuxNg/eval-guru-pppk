<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToTablePPPK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('PPPK', function (Blueprint $table) {
            // Penilaian Disiplin
            $table->float('kejujuran')->nullable()->default(99);
            $table->float('tanggungJawab')->nullable()->default(99);
            $table->float('kehadiran')->nullable()->default(99);
            $table->float('kesetiaan')->nullable()->default(99);
            $table->float('etikaPerilaku')->nullable()->default(99);
            $table->text('catatanDisiplin')->nullable();

            // Penilaian Kinerja
            $table->float('admPerencanaan')->nullable()->default(99);
            $table->float('pelaksanaan')->nullable()->default(99);
            $table->float('admPenilaian')->nullable()->default(99);
            $table->float('rekapitulasiPKG')->nullable()->default(99);
            $table->float('skp')->nullable()->default(99);
            $table->text('catatanKinerja')->nullable();

            // Rekomendasi
            $table->boolean('rekomendasi')->nullable()->default(true);
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
            $table->dropColumn('kejujuran');
            $table->dropColumn('tanggungJawab');
            $table->dropColumn('kehadiran');
            $table->dropColumn('kesetiaan');
            $table->dropColumn('etikaPerilaku');
            $table->dropColumn('catatanDisiplin');
            $table->dropColumn('admPerencanaan');
            $table->dropColumn('pelaksanaan');
            $table->dropColumn('admPenilaian');
            $table->dropColumn('rekapitulasiPKG');
            $table->dropColumn('skp');
            $table->dropColumn('catatanKinerja');
            $table->dropColumn('rekomendasi');
        });
    }
}
