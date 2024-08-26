<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elementos extends Model
{
    use HasFactory;

    //use SoftDeletes;

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'id',
        'elemento',
        'tipo_id',
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    //Método para relacionar un categoría a un proyecto
    public function tipo()
    {
        return $this->belongsTo('App\Models\Tipo');
    }


    public function prestamo()
    {
        return $this->hasMany('App\Models\Prestamos');
    }
}
