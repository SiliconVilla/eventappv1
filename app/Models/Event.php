<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    //Al comentar softdelete la eliminación se hace completamente de la base de datos
    //use SoftDeletes;

    protected $fillable = ['id', 'evento', 'imagen', 'estado_id', 'area_id', 'tipo_evento'];


    //Método para relacionar un proyecto a muchas categorías
    public function activitys()
    {
        return $this->hasMany('App\Models\Activity');
    }
}
