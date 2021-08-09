<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Noticia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$users = User::cumpleMes(2);
        
        /*$cumples = [];

        foreach ($users as $key => $user) {
            $cumples[$key]['title'] = $user->name;
            $cumples[$key]['start'] = $user->dia_cumple;
        }*/

        $noticias = Noticia::orderBy('id', 'DESC')->paginate(3);

        $dailyIndicators  = $this->dailyIndicators();

        $dailyClimate = $this->dailyClimate();

        return view('home', compact('noticias', 'dailyIndicators', 'dailyClimate'));

        //return redirect()->route('users.show', Auth::id());
    }

    //Ver Noticias
    public function showNoticias ()
    {
        return view('noticias.show');
        //$noticia= Noticia::where('slug', $titulo)->first();
        //dd($noticia);
    }

    //indicadores diarios
    public function dailyIndicators ()
    {
        $apiUrl = 'https://mindicador.cl/api';
        //Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
        if ( ini_get('allow_url_fopen') ) {
            $json = file_get_contents($apiUrl);
        } else {
            //De otra forma utilizamos cURL
            $curl = curl_init($apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($curl);
            curl_close($curl);
        }
        
        $dailyIndicators = json_decode($json);

        return $dailyIndicators;
    }

    public function dailyClimate ()
    {
        $apiUrl = 'http://api.meteored.cl/index.php?api_lang=cl&localidad=18578&affiliate_id=ny7bcfb623tj&v=3.0';

        if ( ini_get('allow_url_fopen') ) {
            $json = file_get_contents($apiUrl);
        } else {
            //De otra forma utilizamos cURL
            $curl = curl_init($apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($curl);
            curl_close($curl);
        }
        
        $climate = json_decode($json, true);

        $dailyClimate['symbol_description']   =   $climate['day'][1]['symbol_description'];
        $dailyClimate['tempmin']   =   $climate['day'][1]['tempmin'];
        $dailyClimate['tempmax']   =   $climate['day'][1]['tempmax'];

        return $dailyClimate;

    }
}
