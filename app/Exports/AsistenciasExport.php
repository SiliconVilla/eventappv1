<?php

namespace App\Exports;

use App\Models\Asistencia;
use App\Models\Viewasistencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsistenciasExport implements FromCollection, WithHeadings
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Viewasistencia::all();
        //return Asistencia::all()

    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["user_id", "evento", "actividad", "fecha_actividad", "fecha_registro", "responsable"];
    }
}
