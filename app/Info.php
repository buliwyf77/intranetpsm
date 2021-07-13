<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'infos';

    protected $fillable = [
        'fecha_nacimiento', 
        'fecha_ingreso',
        'nacionalidad',
        'doc_identidad',
        'num_doc',
        'user_id',
        'direccion',
        'telefono',
        'imagen',
        'firma',
        'area_id'
    ];
    
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function area ()
    {
        return $this->belongsTo('App\Area');
    }
    
}
