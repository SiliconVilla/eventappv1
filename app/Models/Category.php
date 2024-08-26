<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    //Eliminación lógica de registros - desactivando
    use SoftDeletes;

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
        protected $fillable = [
            'id', 'namecategoria', 'project_id'
        ];


    //Método para relacionar un categoría a un proyecto
        public function project()
        {
            return $this->belongsTo('App\Models\Project');
        }


        //Método para relacionar un categoría a un proyecto
        public function incident()
        {
            return $this->hasMany('App\Models\Incident');
        }


        //Método para relacionar un categoría a muchos tipos
        public function tipo()
        {
            return $this->hasMany('App\Models\Tipo');
        }


}
