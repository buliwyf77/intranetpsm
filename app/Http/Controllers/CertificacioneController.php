<?php

namespace App\Http\Controllers;

use App\Certificacione;
use App\Proyecto;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\CertificacioneStore;
use App\Http\Requests\CertificacioneUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;


class CertificacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificacione = Certificacione::all();
        return view('certificaciones.index', compact('certificacione'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $certificacione = Certificacione::all();      
        return view('certificaciones.create',compact('certificacione'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificacioneStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        Certificacione::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('certificaciones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\certificacione  $certificacione
     * @return \Illuminate\Http\Response
     */
    public function show(certificacione $certificacione)
    {        
        return view('certificaciones.show', compact('certificacione'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\certificacione  $certificacione
     * @return \Illuminate\Http\Response
     */
    public function edit(certificacione $certificacione)
    {
        
        return view('certificaciones.edit', compact('certificacione'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\certificacione  $certificacione
     * @return \Illuminate\Http\Response
     */
    public function update(CertificacioneStore $request, certificacione $certificacione)
    {
 
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $certificacione->fill($data);
            $certificacione->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('certificaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\certificacione  $certificacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(certificacione $certificacione)
    {        
        try {
       
            $certificacione->delete();
        } catch (Exception $certificacione) {
            alert()->error('Error', $certificacione->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
    }
    return redirect()->route('certificaciones.index');

    }
}
