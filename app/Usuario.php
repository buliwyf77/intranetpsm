<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = ['fecha', 'ciudad', 'user_id', 'directivo_id', 'fecha_aprobacion', 
    'fecha_rechazo', 'solicitud_id'];

    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
