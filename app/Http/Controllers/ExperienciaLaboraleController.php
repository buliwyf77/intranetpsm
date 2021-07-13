<?php

namespace App\Http\Controllers;

use App\ExperienciaLaborale;
use App\EstadoSolicitude;
use App\SolicitudVacacione;
use App\SolicitudAumento;
use App\Directivo;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ExperienciaLaboraleStore;
use App\Http\Requests\ExperienciaLaboraleUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;

class ExperienciaLaboraleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiencia = ExperienciaLaborale::all(); 
       
        return view('experiencias.index', compact('experiencia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');        
        $experiencia = ExperienciaLaborale::all();      
        return view('experiencias.create',compact('experiencia', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienciaLaboraleStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
        
        try {

        ExperienciaLaborale::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();
    
        return redirect()->route('users.show', $data['user_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExperienciaLaborale  $experiencia
     * @return \Illuminate\Http\Response
     */
    public function show(ExperienciaLaborale $experiencia)
    {        
        return view('experiencias.show', compact('experiencia'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExperienciaLaborale  $experiencia
     * @return \Illuminate\Http\Response
     */
    public function edit(ExperienciaLaborale $experiencia)
    {        
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $solicitudes = EstadoSolicitude::orderBy('nombre', 'ASC')->pluck('nombre', 'id');        
        return view('experiencias.edit', compact('experiencia', 'user', 'solicitudes'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExperienciaLaborale  $experiencia
     * @return \Illuminate\Http\Response
     */
    public function update(ExperienciaLaboraleUpdate $request, ExperienciaLaborale $experiencia)
    {
        
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $experiencia->fill($data);
            $experiencia->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('users.show', $experiencia->user_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExperienciaLaborale  $experiencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExperienciaLaborale $experiencia)
    {        
        try {
            $user_id = $experiencia->user_id;
            $experiencia->delete();
        } catch (Exception $experiencia) {
            alert()->error('Error', $experiencia->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        
        alert()->success('Registro Eliminado','El registro se ha eliminado de manera exitosa');

        return redirect()->route('users.show', $user_id);

    }
}
