<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directivo extends Model
{
    protected $table = 'directivos';

    protected $fillable = ['nombre_completo', 'rut', 'cargo', 'email'];
    
   
}
