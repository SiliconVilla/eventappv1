<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incident extends Model
{
    use HasFactory;

    //Eliminación lógica de registros - desactivando
    use SoftDeletes;

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'id',
        'severidad',
        'descripcion',
        'category_id',
        'tipo_id',
        'project_id',
        'level_id',
        'estincident',
        'cliente_id',
        'soporte_id',
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function soporte()
    {
        return $this->belongsTo('App\Models\User', 'soporte_id');
    }


    public function cliente()
    {
        return $this->belongsTo('App\Models\User', 'cliente_id');
    }

    
    public function nivel()
    {
        return $this->belongsTo('App\Models\Level', 'level_id');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Models\Tipo', 'tipo_id');
    }

    public function mensajes()
    {
        return $this->hasMany('App\Models\Mensajes');
    }


    //Accesors
    public function getNombreSoporteAttribute()
    {
        if($this->soporte){
            return $this->soporte->name;
        } else {
            return 'Sin Asignar';
        }
    }
    
    
}
