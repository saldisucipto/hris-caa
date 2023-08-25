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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('nama_employee', 100);
            $table->unsignedBigInteger('id_company', false);
            $table->text('alamat_employee', 100);
            $table->string('alamat_rt_employee', 10);
            $table->string('alamat_rw_employee', 10);
            $table->string('alamat_kec_employee', 75);
            $table->string('alamat_kab_employee', 75);
            $table->string('alamat_prov_employee', 75);
            $table->string('alamat_kode_pos_employee', 75)->nullable();
            $table->string('jabatan_employee', 100);
            $table->string('agama_employee', 50);
            $table->string('phone_employee', 14)->nullable();
            $table->string('email_employee', 100)->nullable();
            $table->unsignedBigInteger('id_grade', false);
            $table->dateTime('tanggal_masuk_employee')->nullable();
            $table->string('tempat_lahir_employee', 50)->nullable();
            $table->dateTime('tanggal_lahir_employee')->nullable();
            $table->enum('jenis_kelamin_employee', ['laki-laki', 'perempuan']);
            $table->enum('status_employee', ['pkwt', 'pkwtt', 'resign']);
            $table->dateTime('masa_kontrak_awal')->nullable();
            $table->dateTime('masa_kontrak_akhir')->nullable();
            $table->string('bpjs_tk_employee', 50)->nullable();
            $table->string('bpjs_ks_employee', 50)->nullable();
            $table->string('npwp_employee', 50)->nullable();
            $table->unsignedBigInteger('id_bank');
            $table->string('bank_account_employee')->nullable();
            $table->string('nama_ibu_employee', 100)->nullable();
            $table->string('nik_employee', 50)->nullable();
            $table->string('no_kk_employee', 50)->nullable();
            $table->enum('status_pernikahan_employee', ['menikah', 'lajang', 'bercerai']);
            $table->tinyInteger('jumlah_anak_employee')->nullable()->default(0);
            $table->foreign('id_grade')->references('id')->on('grade_employee')->onDelete('CASCADE');
            $table->foreign('id_bank')->references('id')->on('bank')->onDelete('CASCADE');
            $table->foreign('id_company')->references('id')->on('company')->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
