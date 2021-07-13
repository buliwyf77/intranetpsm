<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = ['nombre', 'descripcion', 'area_id'];
    
    public function area ()
    {
        return $this->belongsTo('App\Area');
    }

    public function participacion_proyectos ()
    {
        return $this->hasMany('App\ParticipacionProyecto');
    }


}
