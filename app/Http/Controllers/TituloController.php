<?php

namespace App\Http\Controllers;

use App\Titulo;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\TituloStore;
use App\Http\Requests\TituloUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;


class TituloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titulo = Titulo::all();
        return view('titulos.index', compact('titulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titulo = Titulo::all();      
        return view('titulos.create',compact('titulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TituloStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        Titulo::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('titulos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function show(Titulo $titulo)
    {        
        return view('titulos.show', compact('titulo'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Titulo $titulo)
    {
        
        return view('titulos.edit', compact('titulo'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function update(TituloUpdate $request, Titulo $titulo)
    {
 
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $titulo->fill($data);
            $titulo->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('titulos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Titulo $titulo)
    {        
        try {
       
            $titulo->delete();
        } catch (Exception $titulo) {
            alert()->error('Error', $titulo->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
    }
    return redirect()->route('titulos.index');

    }
}
