<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calification extends Model
{
  protected $fillable = [
      'id_user_calificador',  'id_user_calificado', 'id_project', 'comentario', 'calificacion'
  ];
  
  #Funcion para obtener la información de un usuario
  public function find_user($id){
      return User::where('id', $id)->first();
  }
}
