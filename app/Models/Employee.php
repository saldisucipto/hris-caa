<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Type\Integer;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $guarded = [];

    // memperloleh ulang tahun karyawan
    public static function ulangTahunKaryawan()
    {

        // mengambil tangal hari ini
        $hariIni = Carbon::now('Asia/Jakarta');

        // menghitung 7 hari kedepan
        $tujuhHariKedepan = $hariIni->copy()->addDay(30);

        return self::whereBetween('tanggal_lahir_employee', [$hariIni, $tujuhHariKedepan])->get();
        // return $tujuhHariKedepan;
    }



    public function perusahaan()
    {
        return $this->hasOne(Company::class, 'id', 'id_company');
    }

    public function grade()
    {
        return $this->hasOne(GradeEmployee::class, 'id', 'id_grade');
    }

    public function bank()
    {
        return $this->hasOne(GradeEmployee::class, 'id', 'id_bank');
    }

    public function resign()
    {
        return $this->belongsTo(Resign::class, 'id', 'id_employee');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_employee', 'id')->with('jenisCuti')->whereYear('tanggal_mulai_cuti', '=', date('Y'))->orderBy('tanggal_mulai_cuti');
    }

    public function foto()
    {
        return $this->hasOne(Foto::class, 'id_employee', 'id');
    }


    public static function getEmployeData(int $companyId): Collection
    {
        return self::where('id_company', $companyId)->whereNot('status_employee', 'resign')->with(['perusahaan', 'cuti'])->get(['nama_employee', 'nik_employee', 'nik_karyawan_employee', 'jabatan_employee', 'jenis_kelamin_employee', 'tanggal_lahir_employee', 'tanggal_masuk_employee', 'status_employee',]);
    }
}
