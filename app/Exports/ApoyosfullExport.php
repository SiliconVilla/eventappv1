<?php

namespace App\Exports;

use App\Models\Apoyo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ApoyosfullExport implements FromCollection, WithHeadings
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Apoyo::all();

    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["id", "user_id", "apoyo", "estado", "reserva", "tarifa", "servicios", "corresponsabilidad", "created_at", "updated_at"];
    }
}
