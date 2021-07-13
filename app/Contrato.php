<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{

    protected $table = 'contratos';

    protected $fillable = ['fecha_inicio', 'fecha_culminacion', 'horas_trabajo', 'monto_sueldo',
    'tipo_contrato_id', 'user_id', 'cargo_id', 'archivo'];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function tipo_contrato ()
    {
        return $this->belongsTo('App\TipoContrato');
    }

    public function cargo ()
    {
        return $this->belongsTo('App\Cargo');
    }

    public function anexos ()
    {
        return $this->hasMany('App\Anexo');
    }
    
}
