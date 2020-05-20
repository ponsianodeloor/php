<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = [
      'rol_nombre', 'rol_middleware'
    ];
    public function user(){
      return $this->hasMany('App\User');
    }
}
