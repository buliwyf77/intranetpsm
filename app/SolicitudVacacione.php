<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudVacacione extends Model
{
    protected $table = 'solicitud_vacaciones';

    protected $fillable = ['fecha', 'fecha_inicio', 'fecha_culminacion', 'fecha_reintegro', 'cantidad_dia',
     'user_id', 'area_id', 'fecha_aprobacion','fecha_rechazo', 'solicitud_id', 'mensaje_rechazo', 'fecha_ingreso_trabajador', 
     'periodo_vacaciones', 'dias_acumulados', 'de_acuerdo', 'saldo'];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function solicitud ()
    {
        return $this->belongsTo('App\EstadoSolicitude');
    }

    public function historico_vacaciones ()
    {
        return $this->hasMany('App\HistoricoVacacione');
    }

    public function area ()
    {
        return $this->belongsTo('App\Area');
    }
}
