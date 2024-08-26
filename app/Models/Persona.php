<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory;

    use SoftDeletes;

    //Tabla
    protected $table = 'persona';

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'id',
        'user_id',
        'estamento',
        'dependencia',
        'programa',
        'codigo',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

   
    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
    

    public function getEsPsicologoAttribute($value)
    {
        return $this->estamento == 'PSICOLOGO';
    }
    
}
