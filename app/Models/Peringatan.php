<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peringatan extends Model
{
    use HasFactory;

    protected $table = 'peringatan';

    public function jenisPeringatan()
    {
        return $this->hasOne(JenisPeringatan::class, 'id', 'id_jenis_peringatan');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'id_employee')->where('status_employee', '!=', 'resign');
    }
}
