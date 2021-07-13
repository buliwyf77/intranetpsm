<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificacione extends Model
{
    protected $table = 'certificaciones';

    protected $fillable = ['nombre', 'descripcion', 'tipo'];
    
    public function certificacione_usuarios ()
    {
        return $this->hasMany('App\CertificacioneUsuario');
    }

    public function users ()
    {
        return $this->belongsToMany('App\User');
    }

}
