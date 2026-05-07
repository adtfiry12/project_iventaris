<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->bigIncrements('id_inventaris');
            $table->string('kode_inventaris');
            $table->string('nama');
            $table->string('kondisi');
            $table->string('keterangan')->nullable();
            $table->integer('jumlah');
            $table->bigInteger('id_jenis');
            $table->bigInteger('id_ruang');
            $table->date('tgl_register');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
