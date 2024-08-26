<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProyectosUsuario extends Model
{
    use HasFactory;


    //Eliminación lógica de registros - desactivando
    use SoftDeletes;

    protected $table = 'proyectosusuario';

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
        protected $fillable = [
            'level_id', 'nivel', 'project_id', 'proyecto', 'usuario', 'user_id'
        ];

    //Método para relacionar un nivel a un proyecto
        public function project()
        {
            return $this->belongsTo('App\Models\Project');
        }
}

