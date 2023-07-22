<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmpleadosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $empleados = Empleado::select('id','nombre','apellido','email','fecha_contratacion','cargo')->get();
        return view('export',compact('empleados'));
    }
}
