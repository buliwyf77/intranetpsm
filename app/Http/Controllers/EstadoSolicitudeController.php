<?php

namespace App\Http\Controllers;

use App\EstadoSolicitude;
use App\SolicitudVacacione;
use App\SolicitudAumento;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\EstadoSolicitudeStore;
use App\Http\Requests\EstadoSolicitudeUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;


class EstadoSolicitudeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitude = EstadoSolicitude::all();
        return view('solicitudes.index', compact('solicitude'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solicitude = EstadoSolicitude::all();      
        return view('solicitudes.create',compact('solicitude'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadoSolicitudeStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        EstadoSolicitude::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('solicitudes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\estadoSolicitude  $solicitude
     * @return \Illuminate\Http\Response
     */
    public function show(EstadoSolicitude $solicitude)
    {        
        return view('solicitudes.show', compact('solicitude'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\estadoSolicitude  $solicitude
     * @return \Illuminate\Http\Response
     */
    public function edit(EstadoSolicitude $solicitude)
    {        
        
        return view('solicitudes.edit', compact('solicitude'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\estadoSolicitude  $solicitude
     * @return \Illuminate\Http\Response
     */
    public function update(EstadoSolicitudeUpdate $request, EstadoSolicitude $solicitude)
    {
        
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $solicitude->fill($data);
            $solicitude->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('solicitudes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\estadoSolicitude  $solicitude
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstadoSolicitude $solicitude)
    {        
        try {
       
            $solicitude->delete();
        } catch (Exception $solicitude) {
            alert()->error('Error', $solicitude->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
    }
    return redirect()->route('solicitudes.index');

    }
}
