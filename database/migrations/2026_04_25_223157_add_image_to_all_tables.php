<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis', function (Blueprint $table) {
            $table->string('image')->nullable()->after('nama_jenis');
        });
        Schema::table('pengguna', function (Blueprint $table) {
            $table->string('image')->nullable()->after('role');
        });
        Schema::table('karyawan', function (Blueprint $table) {
            $table->string('image')->nullable()->after('no_telp');
        });
        Schema::table('ruang', function (Blueprint $table) {
            $table->string('image')->nullable()->after('keterangan');
        });
        Schema::table('inventaris', function (Blueprint $table) {
            $table->string('image')->nullable()->after('tgl_register');
        });
    }

    public function down(): void
    {
        Schema::table('jenis', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('pengguna', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('ruang', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('inventaris', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
