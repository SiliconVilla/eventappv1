<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccionapi extends Model
{
    use HasFactory;

    //Tabla
    protected $table = 'direccionapi';

    //Atributos
    protected $fillable = ['id', 'url'];

    
}
