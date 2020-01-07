<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public $timestamps = false;
    public $table = 'rol';
    public $fillable = ['nombre', 'descripcion', 'condicion'];

    public function users(){
        return $this->hasMany('App\User');
    }
}
