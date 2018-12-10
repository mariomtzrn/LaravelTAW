<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'email', 'password', 'type', 'descripcion',
        'calificacion', 'foto_perfil'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    #Funcion para obtener los proyectos del usuario
    public function projects(){
      return $this->hasMany(Project::class, 'owner_id');
    }
  
    #Funcion para obtener las propuestas del usuario
    public function propuestas(){
      return $this->hasMany(Propuesta::class, 'id_user');
    }
  
    #Funcion para obtener las calificaciones del usuario
    public function calificaciones(){
      return $this->hasMany(Calification::class, 'id_user_calificado');
    }
  
    #Funcion para obtener los proyectos calificados del usuario
    public function projects_done(){
      return $this->hasMany(Calification::class, 'id_user_calificado');
    }
}
