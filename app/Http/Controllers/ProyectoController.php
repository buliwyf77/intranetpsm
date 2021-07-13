<?php

namespace App\Http\Controllers;

use App\Proyecto;
use App\Area;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ProyectoStore;
use App\Http\Requests\ProyectoUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyecto = Proyecto::all();
        $area = Area::all();
        return view('proyectos.index', compact('proyecto', 'area'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proyecto = Proyecto::all();
        $area = Area::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('proyectos.create',compact('proyecto','area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProyectoStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        Proyecto::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('proyectos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(proyecto $proyecto)
    {
        return view('proyectos.show', compact('proyecto')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit(proyecto $proyecto)
    {
        $area = Area::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('proyectos.edit', compact('proyecto','area')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(ProyectoUpdate $request, proyecto $proyecto)
    {
        $data = $request->all();
        DB::beginTransaction();
        
        try {            
            $proyecto->fill($data);
            $proyecto->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('proyectos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(proyecto $proyecto)
    {
        try {
       
            $proyecto->delete();
        } catch (Exception $proyecto) {
            alert()->error('Error', $proyecto->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        return redirect()->route('proyectos.index');
    }
}
