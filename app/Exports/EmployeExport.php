<?php

namespace App\Exports;

use App\Models\Employee;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeExport implements FromQuery, WithHeadings
{
    public string $company;
    public string $status;
    function __construct(string $company, string $status)
    {
        $this->company = $company;
        $this->status = $status;
    }


    public function query()
    {
        if ($this->company == 'all') {
            return Employee::query()->where('status_employee', '!=', 'resign');
        } elseif ($this->status == 'all') {
            return Employee::where('status_employee', '!=', 'resign')->where('id_company', '=', $this->company);
        } else {
            return Employee::where('status_employee', '=', $this->status)->where('id_company', '=', $this->company);
        }
    }

    public function headings(): array
    {
        return [
            'ID',
            'NAMA KARYAWAN',
            'ID_COMPANY',
            'ALAMAT',
            'RT',
            'RW',
            'KEL',
            'KEC',
            'KAB',
            'PROV',
            'KODE POS',
            'JABATAN',
            'AGAMA',
            'PHONE',
            'EMAIL',
            'ID GRADE',
            'TANGGAL MASUK',
            'NIP',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'JENIS KELAMIN',
            'STATUS KARYAWAN',
            'MASA KONTRAK AWAL',
            'MASA KONTRAK AKHIR',
            'BPJS KETENAGAKERJAAN',
            'BPJS KESEHATAN',
            'NPWP',
            'BANK ID',
            'NOMER REKENING',
            'NAMA IBU KANDUNG',
            'NIK KTP',
            'NOMOR KK',
            'STATUS PERNIKAHAN',
            'JUMLAH ANAK',
            'PENDIDIKAN TERAKHIR'
        ];
    }
}
