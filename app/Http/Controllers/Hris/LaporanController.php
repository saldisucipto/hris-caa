<?php

namespace App\Http\Controllers\Hris;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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
        // dd($reportData);
        $pdf_data = PDF::loadView('hallo', ['data' => $reportData]);
        $pdf_data->loadHTML('<h1> hallo </h1>');

        // return $pdf_data->stream();
        // return Inertia::render("/Laporan/Karyawan", ['report_data' => $reportData]);
    }
}
