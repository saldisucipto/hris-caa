<?php

namespace App\Http\Controllers\Hris;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LaporanController extends Controller
{
    // index function
    public function index()
    {
        $companyData = Company::get(['nama_company', 'id']);
        return Inertia::render('Laporan/Index', ['company' => $companyData]);
    }

    // Laporan Karyawan
    function laporan_karyawan(Request $request)
    {

        $reportData = $request->all();
        dd($reportData);
        return Inertia::render("/Laporan/Karyawan", ['report_data' => $reportData]);
    }
}
