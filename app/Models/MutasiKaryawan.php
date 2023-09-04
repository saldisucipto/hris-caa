<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiKaryawan extends Model
{
    use HasFactory;
    protected $table = 'mutasi_karyawan';
    protected $guarded = [];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'id_employee');
    }

    public function companyAsal()
    {
        return $this->hasOne(Company::class, 'id', 'id_company_asal');
    }

    public function companyTujuan()
    {
        return $this->hasOne(Company::class, 'id', 'id_company_tujuan');
    }
}
