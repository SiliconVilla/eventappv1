<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apoyosfull extends Model
{
    use HasFactory;

    //Eliminación lógica de registros - desactivando
    //use SoftDeletes;

    //Tabla
    protected $table = 'aposyosfull';

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'user_id',
        'apoyo',
        'estado',
        'reserva',
        'tarifa',
        'servicios',
        'horascorr'
    ];
   
}
