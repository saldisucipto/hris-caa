<?php

namespace App\Http\Controllers\Hris;

use App\Exports\EmployeExport;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    // index function
    public function index()
    {
        $companyData = Company::get(['nama_company', 'id']);
        return Inertia::render('Laporan/Index', ['company' => $companyData]);
    }

    // Laporan Karyawan
    function laporan_karyawan()
    {
        return Excel::download(new EmployeExport, 'Data Karyawan ' . Carbon::now('Asia/Jakarta')->toDateTimeString() . '.xlsx');
    }
}
