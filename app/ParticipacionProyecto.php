<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipacionProyecto extends Model
{
    protected $table = 'participacion_proyectos';

    protected $fillable = ['funciones', 'user_id', 'proyecto_id'];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function proyecto ()
    {
        return $this->belongsTo('App\Proyecto');
    }
}
