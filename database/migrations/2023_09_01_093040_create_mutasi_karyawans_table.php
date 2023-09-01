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
        Schema::create('mutasi_karyawan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_employee');
            $table->date('tanggal_mutasi');
            $table->unsignedBigInteger('id_company_asal');
            $table->unsignedBigInteger('id_company_tujuan');
            $table->text('notes');
            $table->timestamps();

            $table->foreign('id_employee')->references('id')->on('employee');
            $table->foreign('id_company_asal')->references('id')->on('company');
            $table->foreign('id_company_tujuan')->references('id')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_karyawan');
    }
};
