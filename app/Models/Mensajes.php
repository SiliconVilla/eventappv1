<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensajes extends Model
{
    use HasFactory;

    //Eliminación lógica de registros - desactivando
    //use SoftDeletes;

    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'id',
        'incident_id',
        'cliente_id',
        'mensaje'
    ];

    public function incident()
    {
        return $this->belongsTo('App\Models\Incident');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'cliente_id');
    }

}
