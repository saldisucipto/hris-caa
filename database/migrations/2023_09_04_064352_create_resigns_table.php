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
        Schema::create('resign', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_employee');
            $table->date('tanggal_resign');
            $table->text('notes');
            $table->timestamps();

            $table->foreign('id_employee')->references('id')->on('employee')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resign');
    }
};
