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
        return Inertia::render('Laporan/Index');
    }
}
