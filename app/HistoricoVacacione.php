<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HistoricoVacacione extends Model
{
    protected $table = 'historico_vacaciones';

    protected $fillable = [ 
        'solicitud_vacacione_id', 'solicitud_id', 'user_id', 'mensaje'
    ];

    public function solicitud_vacacione ()
    {
        return $this->belongsTo('App\SolicitudVacacione');
    }

    public function solicitud ()
    {
        return $this->belongsTo('App\EstadoSolicitude');
    }

    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    // Metodo para actualizar el Hitorico de Vacaciones
    static function actualizarHistorico ($vacacione_id, $solicitud_id, $mensaje = null) 
    {
        $historico = [
            'solicitud_vacacione_id' => $vacacione_id,
            'solicitud_id' => $solicitud_id,
            'mensaje' => $mensaje,
            'user_id' => Auth::id()
        ];

        HistoricoVacacione::create($historico);
        return; 

    }
}
