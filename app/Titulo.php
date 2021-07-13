<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    protected $table = 'titulos';

    protected $fillable = ['nombre', 'descripcion'];
    
    public function titulo_usuario ()
    {
        return $this->hasMany('App\TituloUsuario');
    }

    public function users ()
    {
        return $this->belongsToMany('App\User');
    }
}
