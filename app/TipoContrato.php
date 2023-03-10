<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    protected $table = 'tipo_contratos';

    protected $fillable = ['nombre'];
    
    public function contratos ()
    {
        return $this->hasMany('App\Contrato');
    }
}
