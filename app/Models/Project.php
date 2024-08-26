<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;

    //Eliminación lógica de registros - desactivando
    use SoftDeletes;

        //Validando desde el modelo con métodos publicos estáticos para acceder desde el controlador 
        public static $reglas = [
            'name' => ['required', 'max:255'],
            'descripcion' => [''],
            'date' => ['date']
        ];

        //Validando desde el modelo con métodos publicos estáticos para acceder desde el controlador 
        public static $errormensaje = [
            'name.required' => 'Se necesita un nombre para el registro.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            //'email.required' => 'Se necesita un email para el registro',
            //'email.email' => 'El email ingresado no es válido',
            //'email.max' => 'El email no puede superar los 255 caracteres.',
            //'email.unique' => 'El email ya se encuentra registrado',
            //'password.min' => 'La contraseña debe contener al menos 8 caracteres',
            //'password.required' => 'Se necesita una contraseña para el registro.'
            'date.date' => 'La fecha no tiene un formato correcto'
        ];


        //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
        protected $fillable = [
            'name',
            'descripcion',
            'date'
        ];


        //Relaciones
        public function users()
        {
            return $this->belongsToMany('App\Models\User');
        }


        //Método para relacionar un proyecto a muchas categorías
        public function categories()
        {
            return $this->hasMany('App\Models\Category');
        }

        //Método para relacionar un proyecto a muchos niveles
        public function levels()
        {
            return $this->hasMany('App\Models\Level');
        }


        public function getPrimerNivelIdAttribute()
        {
            //return $this->leves->first()->id;
        }

}
