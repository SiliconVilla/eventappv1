<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;

    //Al comentar softdelete la eliminación se hace completamente de la base de datos
    //use SoftDeletes;

    //Tabla
    protected $table = 'reservations';

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'id',
        'user_id',
        'reserva'
    ];

   
    //Método para relacionar un categoría a un proyecto
    public function apoyo()
    {
        return $this->belongsTo('App\Models\Apoyo', 'id', 'user_id');
    }
    

    
}
