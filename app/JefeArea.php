<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JefeArea extends Model
{
    protected $table = 'jefe_areas';

    protected $fillable = ['area_id', 'user_id'];

    public function area ()
    {
        return $this->belongsTo('App\Area');
    }

    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    //Método para registrar el jefe de área y sus respectivas áreas
    static function register ($user_id, $area_id)
    {
        $jefe_area = JefeArea::create([
            'user_id' => $user_id, 
            'area_id' => $area_id]);
     
        return;
    }
}
