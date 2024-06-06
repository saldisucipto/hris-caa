<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class KaryawanExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public String $id_company;
    // public function __construct($id_company)
    // {
    //     $this->id_company = $id_company;
    // }
    public function collection()
    {
        return Employee::select('id')->get();
    }
}
