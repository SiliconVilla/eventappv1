<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aposyosfull extends Model
{
    use HasFactory;

    //Al comentar softdelete la eliminación se hace completamente de la base de datos
    //use SoftDeletes;

    //Tabla
    protected $table = 'aposyosfull';

    protected $primaryKey = 'user_id';

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'user_id',
        'apoyo',
        'estado',
        'reserva',
        'tarifa',
        'corresponsabilidad',
        'saldoAnterior',
        'cantidadEntrada',
        'cantidadSalida',
        'saldo'
    ];

   
    //Método para relacionar un proyecto a muchas categorías
    public function reservaciones()
    {
        return $this->hasMany('App\Models\Reservation', 'user_id', 'user_id')->orderBy('reserva');
    }
    

    
}
