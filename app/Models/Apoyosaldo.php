<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apoyosaldo extends Model
{
    use HasFactory;

    //Al comentar softdelete la eliminación se hace completamente de la base de datos
    //use SoftDeletes;

    //Tabla
    protected $table = 'apoyo_saldo';

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'id',
        'user_id',
        'saldoAnterior',
        'cantidadEntrada',
        'cantidadSalida',
        'saldo',
        'created_at',
        'updated_at'
    ];

   
    //Método para relacionar un categoría a un proyecto
    public function apoyo()
    {
        return $this->belongsTo('App\Models\Apoyo', 'user_id', 'user_id');
    }
    

    
}
