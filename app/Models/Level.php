<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory;

    //Eliminación lógica de registros - desactivando
    use SoftDeletes;

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
        protected $fillable = [
            'namenivel', 'project_id'
        ];

    //Método para relacionar un nivel a un proyecto
        public function project()
        {
            return $this->belongsTo('App\Models\Project');
        }


        public function projectuser()
        {
            return $this->hasMany('App\Models\ProjectUser');
        }
        
}
