<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
  protected $fillable = [
      'id_user', 'id_project', 'descripcion', 'tiempo', 'estado'
  ];
  
  public function get_project($id){
    return Project::where('id', $id)->first();
  }
  
  public function owner($id_user){
    return User::where('id', $id_user)->first();
  }
}

/**
  Una propuesta tiene 3 estados:
  - Pendiente: 0
  - Aceptada: 1
  - Terminada: 2
**/