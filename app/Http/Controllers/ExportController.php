<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmpleadosExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new EmpleadosExport, 'empleados.xlsx');
    }
}
