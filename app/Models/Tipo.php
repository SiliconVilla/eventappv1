<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    //Tabla
    protected $table = 'tipos';

    //Atributos
    protected $fillable = ['id','name', 'descripcion', 'category_id'];

    //Método para relacionar una categoria a un tipo
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }


    public function elemento()
    {
        return $this->hasMany('App\Models\Elementos');
    }

}
