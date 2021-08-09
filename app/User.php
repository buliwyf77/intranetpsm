<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use App\User;
use App\Info;



use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
 
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'slug', 'area_id', 'activo', 'jefe_area'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function contratos ()
    {
        return $this->hasMany('App\Contrato');
    }

    public function vacaciones ()
    {
        return $this->hasMany('App\SolicitudVacacione');
    }

    public function aumentos ()
    {
        return $this->hasMany('App\SolicitudAumento');
    }

    public function experiencias ()
    {
        return $this->hasMany('App\ExperienciaLaborale');
    }

    public function info ()
    {
        return $this->hasOne('App\Info');
    }

    public function participacion_proyectos ()
    {
        return $this->hasMany('App\ParticipacionProyecto');
    }

    public function habilidades ()
    {
        return $this->belongsToMany('App\Habilidade');
    }

    public function titulos ()
    {
        return $this->belongsToMany('App\Titulo');
    }

    public function certificaciones ()
    {
        return $this->belongsToMany('App\Certificacione');
    }

    public function noticias () 
    {
        return $this->hasMany('App\Noticia');
    }

    public function role ()
    {
        return $this->belongsTo('App\Role');
    }

    public function historico_aumentos (){
        return $this->hasMany('App\HistoricoAumento');
    }
    
    public function historico_vacaciones ()
    {
        return $this->hasMany('App\HistoricoVacacione');
    }

    public function jefe_area ()
    {
        return $this->hasMany('App\JefeArea');
    }
    

    static function getUserCargo($user_id)
    {
        $contrato = Contrato::with('cargo')->where('user_id', $user_id)->first();
        return $contrato->cargo->nombre;
    }

    static function cumpleMes ($month)
    {
        $users = User::with('info')->where('activo', 1)->get();

        $birthdays = [];

        foreach ($users as $key => $user) {

            if($month ==  (date('m', strtotime($user->info->fecha_nacimiento))))
            {
                $birthdays[$key]['id'] = $user->id;
                $birthdays[$key]['name'] = $user->name;
                $birthdays[$key]['image'] = $user->info->imagen;
                $birthdays[$key]['birthday'] = date('d-m', strtotime($user->info->fecha_nacimiento));
            }
        }

        //dd($birthdays);
        
        $birthdays = collect($birthdays);

        $birthdays->all();

        return $birthdays->sortBy('birthday');

    }

    // Metodo para verificar que el usuario tiene firma registrada antes de descargar documentos
    static function verificarFirma ($user_id)
    {

        $info = Info::where('user_id', $user_id)->first();
        if(isset($info->firma) && ($info->firma != NULL)){
            return true;
        } else
        {
            return false;
        }
    }

    //Método para obtener los usuarios de un área especifica
    static function getUsersArea ($area_id)
    {
        
        $users = User::with('info')->get();

        $user_area = [];
        
        foreach ($users as $key => $user) {
            $user_area = Info::where('area_id', $area_id)->get(['user_id']);    
        }

        $users_id = array_column($user_area->toArray(), 'user_id');

        return $users_id;
    }

    //Método para obtener el área de un usuario
    static function getUserArea($user_id)
    {
        $user = User::with('info')->where('id', $user_id)->first();
        return $user->info->area_id;

    }

    //Método para verificar el usuario con permiso a los perfiles

    static function getUserAuthorized($user_id)
    {

        if (Auth::id() == $user_id) {
            $res = true;
        } elseif(Auth::user()->role_id == 1 || Auth::user()->role_id == 4 ) {
            $res = true;
        } else{
            $res = false;
        }

        return $res;
    }

    //Método para verificar el jefe de área 
    static function verifyJefeArea ()
    {
        if(!Auth::user()->jefe_area)
        {
            abort(403); 
        }
    }

    

}
