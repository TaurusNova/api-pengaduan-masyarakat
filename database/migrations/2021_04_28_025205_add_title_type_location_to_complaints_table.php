<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleTypeLocationToComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->date('judul_laporan')->after('nik');
            $table->date('tanggal_kejadian')->after('status');
            $table->date('tanggal_laporan')->after('tanggal_kejadian');
            $table->enum('tipe', ['pengaduan', 'kritik_saran', 'pertanyaan'])->after('foto');
            $table->string('provinsi_kejadian')->after('tipe');
            $table->string('kota_kejadian')->after('provinsi_kejadian');
            $table->string('kecamatan_kejadian')->after('kota_kejadian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            //
        });
    }
}
