<?php

namespace App\Http\Controllers;

use App\Directivo;
use App\SolicitudAumento;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\DirectivoStore;
use App\Http\Requests\DirectivoUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;


class DirectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directivo = Directivo::all();
        return view('directivos.index', compact('directivo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $directivo = Directivo::all();      
        return view('directivos.create',compact('directivo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectivoStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        Directivo::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('directivos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\directivo  $directivo
     * @return \Illuminate\Http\Response
     */
    public function show(directivo $directivo)
    {        
        return view('directivos.show', compact('directivo'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\directivo  $directivo
     * @return \Illuminate\Http\Response
     */
    public function edit(directivo $directivo)
    {
        
        return view('directivos.edit', compact('directivo'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\directivo  $directivo
     * @return \Illuminate\Http\Response
     */
    public function update(DirectivoUpdate $request, directivo $directivo)
    {
 
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $directivo->fill($data);
            $directivo->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('directivos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\directivo  $directivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(directivo $directivo)
    {        
        try {
       
            $directivo->delete();
        } catch (Exception $directivo) {
            alert()->error('Error', $directivo->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
    }
    return redirect()->route('directivos.index');

    }
}
