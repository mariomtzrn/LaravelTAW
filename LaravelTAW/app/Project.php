<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $fillable = [
      'titulo',  'descripcion', 'owner_id', 'presupuesto', 'fecha_entrega', 'categoria', 'estado'
  ];

  #Funcion para obtener las propuestas del proyecto
  public function propuestas(){
    return $this->hasMany(Propuesta::class, 'id_project');
  }
  
  #Funcion para obtener la propuesta del usuario en sesion
  public function propuesta_user(){
    return $this->hasOne(Propuesta::class, 'id_project')->where('id_user', Auth()->id());
  }
  
  ##Funcion para obtener la informacion del dueño del proyecto
  public function owner(){
    return $this->belongsTo(User::class, 'owner_id');
  }
  
  #Funcion para verificar que el proyecto tenga una propuesta aceptada
  public function propuesta_aceptada(){
    return $this->hasOne(Propuesta::class, 'id_project')->where('estado', 1);
  }
  
  #Funcion para verificar que el proyecto tenga una propuesta terminada
  public function propuesta_terminada(){
    return $this->hasOne(Propuesta::class, 'id_project')->where('estado', 2);
  }
}

/**
  Un proyecto tiene 2 estados:
  - Activo: 0
  - No disponible
  - Terminado: 1
**/