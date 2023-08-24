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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('nama_company', 100);
            $table->text('alamat_company');
            $table->string('logo_company');
            $table->string('phone_company', 14);
            $table->string('fax_company', 14);
            $table->string('email_company', 100);
            $table->string('npwp_company', 50);
            $table->string('website_company', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
