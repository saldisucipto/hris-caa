<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::all();
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
