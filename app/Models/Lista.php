<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lista extends Model
{

    use HasFactory;

    //Eliminación lógica de registros - desactivando
    use SoftDeletes;
    //Tabla
    //protected $table = 'lists';

    //Tabla
    protected $table = 'listas';

    //Atributos
    protected $fillable = ['activity_id', 'event_id', 'anio', 'dia_sem', 'dia_mes', 'mes', 'actividad', 'lugar', 'latitud', 'longitud', 'descripcion', 'hora', 'fechafull', 'imagen', 'evento', 'deleted_at'];
}
