<?php

namespace App\Http\Controllers;

use App\HabilidadeUsuario;
use App\Habilidade;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\HabilidadeUsuarioStore;
use App\Http\Requests\HabilidadeUsuarioUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;

class HabilidadeUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habilidade_usuario = HabilidadeUsuario::all();
        $user = User::all();
        return view('habilidade_usuarios.index', compact('habilidade_usuario', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $habilidade = Habilidade::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('habilidade_usuarios.create',compact('user', 'habilidade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HabilidadeUsuarioStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        HabilidadeUsuario::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('habilidade_usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\habilidadeUsuario  $habilidadeUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(HabilidadeUsuario $habilidade_usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\habilidadeUsuario  $habilidadeUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit(HabilidadeUsuario $habilidade_usuario)
    {   
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $habilidade = Habilidade::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        
        return view('habilidade_usuarios.edit', compact('habilidade_usuario','user','habilidade')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\habilidadeUsuario  $habilidadeUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(HabilidadeUsuarioUpdate $request, HabilidadeUsuario $habilidade_usuario)
    {
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $habilidade_usuario->fill($data);
            $habilidade_usuario->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('habilidade_usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\habilidadeUsuario  $habilidadeUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(HabilidadeUsuario $habilidade_usuario)
    {
        try {
       
            $habilidade_usuario->delete();
        } catch (Exception $habilidade_usuario) {
            alert()->error('Error', $habilidade_usuario->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        return redirect()->route('habilidade_usuarios.index');
    }
}
