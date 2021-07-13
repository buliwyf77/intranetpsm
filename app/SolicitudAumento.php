<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudAumento extends Model
{
    protected $table = 'solicitud_aumentos';

    protected $fillable = ['fecha',  'user_id', 'proyectos_funciones', 'otras_funciones', 'solicitud_id'];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function historico_aumentos (){
        return $this->hasMany('App\HistoricoAumento');
    }

    public function solicitud ()
    {
        return $this->belongsTo('App\EstadoSolicitude');
    }

}
