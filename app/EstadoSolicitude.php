<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoSolicitude extends Model
{
    protected $table = 'estado_solicitudes';

    protected $fillable = ['nombre', 'descripcion', 'color'];
    
    public function vacaciones ()
    {
        return $this->hasMany('App\SolicitudVacacione');
    }

    public function historico_aumentos (){
        return $this->hasMany('App\HistoricoAumento');
    }

    public function solicitud_aumentos (){
        return $this->hasMany('App\SolicitudAumento');
    }

    public function historico_vacaciones ()
    {
        return $this->hasMany('HistoricoVacacione');
    }
}
