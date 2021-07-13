<?php

namespace App\Http\Controllers;

use App\CertificacioneUsuario;
use App\Certificacione;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\CertificacioneUsuarioStore;
use App\Http\Requests\CertificacioneUsuarioUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;

class CertificacioneUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificacione_usuario = CertificacioneUsuario::all();
        $user = User::all();
        return view('certificacione_usuarios.index', compact('certificacione_usuario', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $certificacione = Certificacione::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('certificacione_usuarios.create',compact('user', 'certificacione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificacioneUsuarioStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        CertificacioneUsuario::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('certificacione_usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\certificacioneUsuario  $certificacioneUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(CertificacioneUsuario $certificacione_usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\certificacioneUsuario  $certificacioneUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit(CertificacioneUsuario $certificacione_usuario)
    {   
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $certificacione = Certificacione::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        
        return view('certificacione_usuarios.edit', compact('certificacione_usuario','user','certificacione')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\certificacioneUsuario  $certificacioneUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(CertificacioneUsuarioUpdate $request, CertificacioneUsuario $certificacione_usuario)
    {
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $certificacione_usuario->fill($data);
            $certificacione_usuario->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('certificacione_usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\certificacioneUsuario  $certificacioneUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(CertificacioneUsuario $certificacione_usuario)
    {
        try {
       
            $certificacione_usuario->delete();
        } catch (Exception $certificacione_usuario) {
            alert()->error('Error', $certificacione_usuario->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        return redirect()->route('certificacione_usuarios.index');
    }
}
