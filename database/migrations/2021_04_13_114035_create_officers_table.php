<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officers', function (Blueprint $table) {
            $table->integer('id_petugas')->autoIncrement();
            $table->string('nama_petugas', 35);
            $table->string('username', 25);
            $table->string('password', 32);
            $table->string('telp', 14);
            $table->enum('level', ['admin', 'petugas']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officers');
    }
}
