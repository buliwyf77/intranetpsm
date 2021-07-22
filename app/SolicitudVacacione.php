<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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


    /** Método para realizar el calculo de dias de vacaciones */

    public static function calcularFechaCulminacion ($fecha_inicio, $dias_solicitados)
    {

        $fecha_inicio = date('Y-m-d H:i:s', strtotime($fecha_inicio));

        $dt = Carbon::create($fecha_inicio);
        
        $dt->setWeekendDays([
            Carbon::SATURDAY,
            Carbon::SUNDAY,
        ]);

        $dt->addDay($dias_solicitados);

        $dif = $dt->diffInWeekendDays();

        $dt->addDay($dif);

        if($dt->isSaturday()){
            $dt->addDay(2);
        }

        if($dt->isSunday()){
            $dt->addDay(1);
        }
        
        return $dt->format('Y-m-d');

    }

    /**Método para calcular la fecha de reintegro */
    public static function calcularFechaReintegro ($fecha_culminacion)
    {
        $dt = Carbon::create($fecha_culminacion);

        $dt->addDay(1);

        if($dt->isSaturday()){
            $dt->addDay(2);
        }

        if($dt->isSunday()){
            $dt->addDay(1);
        }
        
        return $dt->format('Y-m-d');
    }

}
