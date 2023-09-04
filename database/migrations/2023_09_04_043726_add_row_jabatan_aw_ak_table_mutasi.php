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
        Schema::table('mutasi_karyawan', function (Blueprint $table) {
            //
            $table->string('jabatan_awal')->after('tanggal_mutasi')->nullable();
            $table->string('jabatan_tujuan')->after('jabatan_awal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mutasi_karyawan', function (Blueprint $table) {
            //
        });
    }
};
