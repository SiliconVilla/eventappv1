<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apoyo extends Model
{
    use HasFactory;

    //Al comentar softdelete la eliminación se hace completamente de la base de datos
    //use SoftDeletes;

    //Tabla
    protected $table = 'apoyos';

    //protected $primaryKey = 'user_id';

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'id',
        'email',
        'apoyo',
        'estado',
        'reserva',
        'tarifa',
        'servicio',
        'corresponsabilidad'
    ];

   
    //Método para relacionar un proyecto a muchas categorías
    public function reservaciones()
    {
        return $this->hasMany('App\Models\Reservation', 'user_id', 'id')->orderBy('reserva');
    }


    public function saldos()
    {
        return $this->hasMany('App\Models\Apoyosaldo', 'user_id', 'id');
    }
    

    
}
