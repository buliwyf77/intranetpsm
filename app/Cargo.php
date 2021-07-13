<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';

    protected $fillable = ['nombre', 'descripcion', 'funcion'];
    
    public function contratos ()
    {
        return $this->hasMany('App\Contrato');
    }
}
