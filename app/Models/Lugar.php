<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    use HasFactory;

    //Tabla
    protected $table = 'places';

    //Atributos
    protected $fillable = ['id', 'place', 'latitud', 'longitud', 'tipo'];

    //Método para relacionar un proyecto a muchas categorías
    public function activitys()
    {
        return $this->hasMany('App\Models\Activity');
    }
}
