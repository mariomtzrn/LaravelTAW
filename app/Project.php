<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $fillable = [
      'titulo',  'descripcion', 'owner_id', 'presupuesto', 'fecha_entrega', 'categoria'
  ];

  public function propuestas(){
    return $this->hasMany(Propuesta::class, 'id_project');
  }
}
