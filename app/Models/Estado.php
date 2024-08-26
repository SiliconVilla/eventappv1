<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    //Tabla
    protected $table = 'estados';

    //Atributos
    protected $fillable = ['id', 'estado'];

    //Método para relacionar un proyecto a muchas categorías
    public function activitys()
    {
        return $this->hasMany('App\Models\Activity');
    }
}
