<?php

namespace App\Exports;

use App\Models\Viewcorrespon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class CorresponsabilidadExport implements FromCollection, WithHeadings
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Viewcorrespon::all();

    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["id", "actividad", "user_id", "horas", "fecha", "responsable"];
    }
}
