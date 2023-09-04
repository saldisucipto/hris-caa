<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    public function jenisCuti()
    {
        return $this->hasOne(JenisCuti::class, 'id', 'id_jenis_cuti');
    }

    public function employeeData()
    {
        return $this->hasOne(Employee::class, 'id', 'id_employee');
    }
}
