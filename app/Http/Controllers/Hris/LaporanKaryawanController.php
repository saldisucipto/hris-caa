<?php

namespace App\Http\Controllers\Hris;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaporanKaryawanRequest;
use App\Models\Company;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Inertia\Inertia;

class LaporanKaryawanController extends Controller
{
    public function karyawan()
    {
        $companyData = Company::get(['nama_company', 'id']);
        return Inertia::render('Laporan/Karyawan', ['company' => $companyData]);
    }

    public function laporanKaryawan(LaporanKaryawanRequest $request)
    {
        $company = $request->company;
        $data = Employee::getEmployeData($company);
    }
}
