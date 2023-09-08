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
        Schema::create('peringatan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_peringatan');
            $table->unsignedBigInteger('id_employee');
            $table->unsignedBigInteger('id_jenis_peringatan');
            $table->text('deskripsi_peringatan');
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('id_employee')->references('id')->on('employee')->onDelete('CASCADE');
            $table->foreign('id_jenis_peringatan')->references('id')->on('jenis_peringatan')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peringatan');
    }
};
