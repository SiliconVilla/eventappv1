<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestamos extends Model
{
    use HasFactory;
    //Eliminación lógica de registros - desactivando
    use SoftDeletes;

    protected $table = 'listaprestamos';
    //Protegiendo en acceso a los campos, cuando se envía guardado por asegnación masiva desde el controlador ->all()
    protected $fillable = [
        'id',
        'elemento',
        'tipo',
        'categoria',
        'descripcion',
        'user_id',
        'usuario',
        'estamento',
        'codigo',
        'email',
        'celular',
        'servidor',
        'fecha',
        'deleted_at',
        'updated_at'
    ];

    public function elemento()
    {
        return $this->belongsTo('App\Models\Elementos');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function soporte()
    {
        return $this->belongsTo('App\Models\User', 'soporte_id');
    }
}
