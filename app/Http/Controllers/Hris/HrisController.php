<?php

namespace App\Http\Controllers\Hris;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Http\Charts\VisitorCharts;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Data\MasterDataController;
use App\Http\Utils\FileProcess;
use App\Imports\EmployeeImport;
use App\Models\Bank;
use App\Models\Company;
use App\Models\Employee;
use App\Models\LastEdu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    // show employee managamente
    public function dataKaryawan()
    {
        return Inertia::render('Hris/Employee/EmployeeData', ['employee' => MasterDataController::ambilSemuaData(new Employee())]);
    }

    // import data karyawan
    public function importDataKaryawan(Request $request)
    {
        if ($request->isMethod('GET')) {
            return Inertia::render('Hris/Employee/ImportEmployee');
        } elseif ($request->isMethod('POST')) {
            $request->validate([
                'fileData' => 'required|mimes:csv,xls,xlsx'
            ]);
            $dokumen = new FileProcess($request->file('fileData'), 'importexcel', 'excel');
            Excel::import(new EmployeeImport, $request->file('fileData')->store('temp'));
            return redirect('/hris/karyawan/data-karyawan')->with('message', 'Berhasil Import Data');
        }
    }
}
