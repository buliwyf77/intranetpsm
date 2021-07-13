<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExperienciaLaborale extends Model
{
    protected $table = 'experiencia_laborales';

    protected $fillable = ['empresa', 'cargo', 'fecha_inicio', 'fecha_termino', 'funciones', 'user_id'];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
