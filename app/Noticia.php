<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    use SoftDeletes;
    
    protected $table = 'noticias';

    protected $fillable = ['titulo', 'descripcion', 'slug', 'imagen', 'user_id'];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
