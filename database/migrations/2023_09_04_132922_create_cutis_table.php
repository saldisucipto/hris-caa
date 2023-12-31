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
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_cuti');
            $table->unsignedBigInteger('id_employee');
            $table->date('tanggal_mulai_cuti');
            $table->date('tanggal_akhir_cuti');
            $table->text('keterangan_cuti');
            $table->integer('jumlah_cuti');
            // $table->timestamps();

            $table->foreign('id_jenis_cuti')->references('id')->on('jenis_cuti')->onDelete('CASCADE');
            $table->foreign('id_employee')->references('id')->on('employee')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
