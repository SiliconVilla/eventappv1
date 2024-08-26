<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    use HasFactory;
    //Tabla
    protected $table = 'activitys';

    //Atributos
    protected $fillable = ['id', 'event_id', 'actividad', 'descripcion', 'place_id', 'fecha', 'estado_id', 'horasc'];


    //Método para relacionar un categoría a un proyecto
    public function project()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }

    //Método para relacionar un categoría a un proyecto
    public function lugar()
    {
        return $this->belongsTo('App\Models\Lugar', 'place_id');
    }

    //Método para relacionar un categoría a un proyecto
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id');
    }

    //Método para relacionar un categoría a un proyecto
    public function asistencia()
    {
        return $this->hasMany('App\Models\Asistencia', 'id');
    }
}
