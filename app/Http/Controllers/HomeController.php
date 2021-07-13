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
        $users = User::cumpleMes();
        
        $cumples = [];

            foreach ($users as $key => $user) {
                $cumples[$key]['title'] = $user->name;
                $cumples[$key]['start'] = $user->dia_cumple;
            }

            $noticias = Noticia::orderBy('id', 'DESC')->paginate(3);

        return view('home', compact('users', 'noticias'));

        //return redirect()->route('users.show', Auth::id());
    }

    //Ver Noticias
    public function showNoticias ()
    {
        return view('noticias.show');
        //$noticia= Noticia::where('slug', $titulo)->first();
        //dd($noticia);
    }
}
