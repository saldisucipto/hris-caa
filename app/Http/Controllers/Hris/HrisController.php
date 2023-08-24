<?php

namespace App\Http\Controllers\Hris;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Http\Charts\VisitorCharts;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Data\MasterDataController;
use App\Models\Bank;
use App\Models\Company;
use App\Models\Employee;
use App\Models\LastEdu;

class HrisController extends Controller
{

    // home function
    public function index(VisitorCharts $chart)
    {
        $company = DB::table('company')->count();
        $employee = DB::table('employee')->count();
        return Inertia::render('Hris/Index', ['chart' => $chart->build(), 'company' => $company, 'employee' => $employee,]);
    }

    // employee function
    public function karyawan()
    {
        return Inertia::render('Hris/Employee/Employee');
    }


    public function dataKaryawan()
    {
        return Inertia::render('Hris/Employee/EmployeeData', ['employee' => MasterDataController::ambilSemuaData(new Employee())]);
    }
}
