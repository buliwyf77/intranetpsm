<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacione extends Model
{
    protected $table = 'liquidaciones';

    protected $fillable = [
        'user_id',
        'fecha',
        'archivo'
    ];

    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
