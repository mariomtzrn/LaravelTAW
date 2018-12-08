<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
  protected $fillable = [
      'id_user', 'id_project', 'descripcion', 'tiempo'
  ];
}
