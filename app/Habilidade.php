<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habilidade extends Model
{
    protected $table = 'habilidades';

    protected $fillable = ['nombre', 'descripcion'];
    
    
    /*public function habilidade_usuario ()
    {
        return $this->hasMany('App\HabilidadeUsuario');
    }*/

    public function users ()
    {
        return $this->belongsToMany('App\User');
    }
}
