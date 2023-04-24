<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    //
    
    protected $table = 'documentos';
    protected  $primaryKey = 'id';

    protected $fillable = ['nombre', 'user_id', 'visible', 'url'];

    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
