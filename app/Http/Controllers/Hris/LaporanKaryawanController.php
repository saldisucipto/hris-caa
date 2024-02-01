<?php

namespace App\Http\Controllers\Hris;

use App\Http\Controllers\Controller;
use App\Http\Requests\LaporanKaryawanRequest;
use App\Models\Company;
use App\Models\Employee;
use Inertia\Inertia;
use PdfReport;

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
        $columns = [ // Set Column to be displayed
            'Name' => 'name',
            'Registered At', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
            'Total Balance' => 'balance',
            'Status' => function ($result) { // You can do if statement or any action do you want inside this closure
                return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            }
        ];
        // return PdfReport::of('tes', ['tes1', 'tes2'], $data, $kolom)->limit(20)->stream();
        return PdfReport::of('tes', ['tes1', 'tes2'], $data, $columns)
            ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                'displayAs' => function ($result) {
                    return $result->registered_at->format('d M Y');
                },
                'class' => 'left'
            ])
            ->editColumns(['Total Balance', 'Status'], [ // Mass edit column
                'class' => 'right bold'
            ])
            ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            ])
            ->limit(20) // Limit record to be showed
            ->stream(); // o
    }
}
