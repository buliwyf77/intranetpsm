<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HabilidadeUsuario extends Model
{
    protected $table = 'habilidade_usuarios';

    protected $fillable = ['user_id', 'habilidade_id'];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function habilidade ()
    {
        return $this->belongsTo('App\Habilidade');
    }

}
