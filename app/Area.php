<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['nombre', 'descripcion'];
    
    public function proyectos ()
    {
        return $this->hasMany('App\Proyecto');
    }

    public function jefe_areas ()
    {
        return $this->hasMany('App\JefeArea');
    }

    public function solicitud_vacaciones ()
    {
        return $this->hasMany('App\SolicitudVacacione');
    }
}
