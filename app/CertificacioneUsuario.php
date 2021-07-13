<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificacioneUsuario extends Model
{
    protected $table = 'certificacione_usuarios';

    protected $fillable = ['user_id', 'certificacione_id'];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function certificacione ()
    {
        return $this->belongsTo('App\Certificacione');
    }
}
