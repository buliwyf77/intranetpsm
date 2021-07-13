<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracione extends Model
{
    protected $table = 'configuraciones';

    protected $fillable = [
        'nombre_empresa',
        'direccion',
        'rut',
        'logo',
        'telefono',
        'email',
        'ciudad',
        'pagina_web'
    ];


    //Datos de la Empresa PSM
    static function empresa ()
    {
        return Configuracione::find(1);
    }
    
}

