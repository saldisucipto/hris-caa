<?php

namespace App\Http\Controllers\Hris;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LaporanController extends Controller
{
    // index function
    public function index()
    {
        return Inertia::render('Laporan/Index');
    }

    // karyawan
    public function karyawan()
    {
        $karyawan1 = Employee::limit(2)->get(['nama_employee', 'alamat_employee', 'alamat_rt_employee', 'alamat_rw_employee', 'alamat_kel_employee', 'alamat_kec_employee', 'alamat_kab_employee', 'alamat_prov_employee', 'alamat_kode_pos_employee', 'jabatan_employee', 'agama_employee', 'phone_employee', 'email_employee', 'tanggal_masuk_employee', 'nik_karyawan_employee']);
        $karyawan = Employee::limit(1)->get();
        dd($karyawan);
        return Inertia::render('Laporan/Karyawan', ['karyawaan' => $karyawan]);
    }
}
