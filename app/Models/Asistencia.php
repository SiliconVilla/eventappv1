<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asistencia extends Model
{
    use HasFactory;

    //Eliminación lógica de registros - desactivando
    //use SoftDeletes;

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'id',
        'email',
        'actividad',
        'user_id',
        'activity_id',
        'fecha',
        'metodoreg'
        /*'tipo_id',
        'project_id',
        'level_id',
        'estincident',
        'cliente_id',
        'soporte_id',
        'created_at',
        'deleted_at',
        'updated_at'*/
    ];


    //Método para relacionar un proyecto a muchas categorías
    public function activitys()
    {
        return $this->belongsTo('App\Models\Activity', 'activity_id');
    }


    //Método para relacionar un proyecto a muchas categorías
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
