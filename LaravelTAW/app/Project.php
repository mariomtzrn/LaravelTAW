<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $fillable = [
      'titulo',  'descripcion', 'owner_id', 'presupuesto', 'fecha_entrega', 'categoria', 'estado'
  ];

  public function propuestas(){
    return $this->hasMany(Propuesta::class, 'id_project');
  }
  
  public function propuesta_user(){
    return $this->hasOne(Propuesta::class, 'id_project')->where('id_user', Auth()->id());
  }
  
  public function owner(){
    return $this->belongsTo(User::class, 'owner_id');
  }
  
  public function propuesta_aceptada(){
    return $this->hasOne(Propuesta::class, 'id_project')->where('estado', 1);
  }
  
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