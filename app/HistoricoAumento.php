<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HistoricoAumento extends Model
{
    protected $table = 'historico_aumentos';

    protected $fillable = [
        'solicitud_aumento_id', 'solicitud_id', 'user_id', 'mensaje'
    ];

    public function solicitud_aumento (){
        return $this->belongsTo('App\SolicitudAumento');
    }

    public function solicitud (){
        return $this->belongsTo('App\EstadoSolicitude');
    }

    public function user (){
        return $this->belongsTo('App\User');
    }

    //Metodo para actualizar cambios en el historico de aumento

    static function actualizarHistorico ($aumento_id, $solicitud_id, $mensaje = null) 
    {
        $historico = [
            'solicitud_aumento_id' => $aumento_id,
            'solicitud_id' => $solicitud_id,
            'mensaje' => $mensaje,
            'user_id' => Auth::id()
        ];

        HistoricoAumento::create($historico);
        return; 

    }

}
