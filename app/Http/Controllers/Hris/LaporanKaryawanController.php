<?php

namespace App\Http\Controllers\Hris;

use App\Exports\KaryawanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\LaporanKaryawanRequest;
use App\Models\Company;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

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
        Excel::download(new KaryawanExport(), 'users.xlsx');
        return redirect()->back();
    }
}
