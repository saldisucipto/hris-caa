<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Employee([
            'nama_employee' => ucfirst($row[0]),
            'id_company' => $row[1],
            'alamat_employee' => $row[2],
            'alamat_rt_employee' => $row[3],
            'alamat_rw_employee' => $row[4],
            'alamat_kel_employee' => $row[5],
            'alamat_kec_employee' => $row[6],
            'alamat_kab_employee' => $row[7],
            'alamat_prov_employee' => $row[8],
            'alamat_kode_pos_employee' => $row[9],
            'jabatan_employee' => $row[10],
            'agama_employee' => $row[11],
            'phone_employee' => $row[12],
            'email_employee' => $row[13],
            'id_grade' => $row[14],
            'tanggal_masuk_employee' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[15]),
            'tempat_lahir_employee' => $row[17],
            'nik_karyawan_employee' => $row[16],
            'tanggal_lahir_employee' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[18]),
            'jenis_kelamin_employee' => $row[19],
            'status_employee' => $row[20],
            'masa_kontrak_awal' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21]),
            'masa_kontrak_akhir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[22]),
            'bpjs_tk_employee' => $row[23],
            'bpjs_ks_employee' => $row[24],
            'npwp_employee' => $row[25],
            'id_bank' => $row[26],
            'bank_account_employee' => $row[27],
            'nama_ibu_employee' => $row[28],
            'nik_employee' => $row[29],
            'no_kk_employee' => $row[30],
            'status_pernikahan_employee' => $row[31],
            'jumlah_anak_employee' => $row[32],
            'last_edu' => $row[33],
        ]);
    }
}
