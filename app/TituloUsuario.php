<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TituloUsuario extends Model
{
    protected $table = 'titulo_usuarios';

    protected $fillable = ['user_id', 'titulo_id'];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function titulo ()
    {
        return $this->belongsTo('App\Titulo');
    }
}
