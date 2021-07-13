<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $table='anexos';
    
    protected $fillable = ['fecha', 'tipo_contrato_id', 'archivo', 'contrato_id'];

    public function contrato ()
    {
        return $this->belongsTo('App\Contrato'); 
    }

    public function tipo_contrato ()
    {
        return $this->belongsTo('App\TipoContrato'); 
    }
}
