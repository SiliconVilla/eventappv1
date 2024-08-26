<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //Eliminación lógica de registros - desactivando
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'documento',
        'password',
        'precioinv_id',
        'corresponsabilidad',
        'seleccionar_proyecto_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relaciones
    public function projects()
    {
        return $this->belongsToMany('App\Models\Project');
    }
    

    public function incidents()
    {
        return $this->hasMany('App\Models\Incident', 'id');
    }

    public function mensajes()
    {
        return $this->hasMany('App\Models\Mensaje', 'id');
    }

    public function contratos()
    {
        return $this->hasMany('App\Models\Contract', 'id');
    }


    //Método para relacionar un categoría a un proyecto
    public function asistencias()
    {
        return $this->belongsTo('App\Models\Asistencia');
    }


    public function prestamo()
    {
        return $this->hasMany('App\Models\Prestamos', 'id');
    }

    public function persona()
    {
        return $this->hasMany('App\Models\Persona', 'email');
    }

    public function ordenes()
    {
        return $this->hasMany('App\Models\Order', 'id', 'client_id');
    }

    public function instituciones()
    {
        return $this->belongsToMany(Institution::class, 'institution_user', 'id_user', 'id_institution');
    }
    


    public function getListadoProyectosAttribute()
    {
        if($this->role == 1){
            return $this->projects;
        }
        
        return Project::all();
    }


    //Accesor

    public function getEsAdminAttribute($value)
    {
        return $this->role == 0;
    }

    public function getEsClienteAttribute($value)
    {
        return $this->role == 2;
    }

    public function getEsSoporteAttribute($value)
    {
        return $this->role == 1;
    }

    public function getEsComercialAttribute($value)
    {
        return $this->role == 9;
    }

    public function getEsDirectoradminAttribute($value)
    {
        return $this->role == 10;
    }



    public function getAvatarPathAttribute($value)
    {
        if ($this->es_cliente) {
            return '../public/imagenes/avatar_usuario.png';
        }
        return '../public/imagenes/ico-service.png';
    }

}
