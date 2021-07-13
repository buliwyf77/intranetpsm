<?php

namespace App\Http\Controllers;

use App\TituloUsuario;
use App\Titulo;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\TituloUsuarioStore;
use App\Http\Requests\TituloUsuarioUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;

class TituloUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulo_usuario = TituloUsuario::all();
        $user = User::all();
        return view('titulo_usuarios.index', compact('titulo_usuario', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $titulo = Titulo::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('titulo_usuarios.create',compact('user', 'titulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TituloUsuarioStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        TituloUsuario::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('titulo_usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tituloUsuario  $tituloUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(TituloUsuario $titulo_usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tituloUsuario  $tituloUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit(TituloUsuario $titulo_usuario)
    {   
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $titulo = Titulo::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        
        return view('titulo_usuarios.edit', compact('titulo_usuario','user','titulo')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tituloUsuario  $tituloUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(TituloUsuarioUpdate $request, TituloUsuario $titulo_usuario)
    {
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $titulo_usuario->fill($data);
            $titulo_usuario->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('titulo_usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tituloUsuario  $tituloUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(TituloUsuario $titulo_usuario)
    {
        try {
       
            $titulo_usuario->delete();
        } catch (Exception $titulo_usuario) {
            alert()->error('Error', $titulo_usuario->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        return redirect()->route('titulo_usuarios.index');
    }
}
