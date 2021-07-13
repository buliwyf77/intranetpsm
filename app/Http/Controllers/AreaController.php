<?php

namespace App\Http\Controllers;

use App\Area;
use App\Proyecto;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\AreaStore;
use App\Http\Requests\AreaUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $area = Area::all();
        return view('areas.index', compact('area'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = Area::all();      
        return view('areas.create',compact('area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        Area::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('areas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(area $area)
    {        
        return view('areas.show', compact('area'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(area $area)
    {
        
        return view('areas.edit', compact('area'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaUpdate $request, area $area)
    {
 
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $area->fill($data);
            $area->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('areas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(area $area)
    {       
        //Verificar si esxisten usuarios en un area antes de eliminar
        if(User::where('area_id', $area->id)->count() > 0)
        {
            alert()->error('¡Advertencia!', 'No puedes eliminar el área debido a que existen usuarios registrados')->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }

        if(Proyecto::where('area_id', $area->id)->count() > 0)
        {
            alert()->error('¡Advertencia!', 'No puedes eliminar el área debido a que existen proyectos registrados')->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        
        try {
       
            $area->delete();
        } catch (Exception $area) {
            alert()->error('Error', $area->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
    }
    
    alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

    return redirect()->route('areas.index');

    }
}
