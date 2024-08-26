<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contarservicio extends Model
{

    use HasFactory;

    //Eliminación lógica de registros - desactivando
    //use SoftDeletes;
    //Tabla
    //protected $table = 'lists';

    //Tabla
    protected $table = 'contarservicios';

    //Atributos
    protected $fillable = ['user_id', 'tarifa', 'actividad', 'fecha', 'lugar'];
}
