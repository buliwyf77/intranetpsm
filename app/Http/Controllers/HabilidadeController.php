<?php

namespace App\Http\Controllers;

use App\Habilidade;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\HabilidadeStore;
use App\Http\Requests\HabilidadeUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;


class HabilidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habilidade = Habilidade::all();
        return view('habilidades.index', compact('habilidade'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $habilidade = Habilidade::all();      
        return view('habilidades.create',compact('habilidade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HabilidadeStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        Habilidade::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('habilidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\habilidade  $habilidade
     * @return \Illuminate\Http\Response
     */
    public function show(habilidade $habilidade)
    {        
        return view('habilidades.show', compact('habilidade'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\habilidade  $habilidade
     * @return \Illuminate\Http\Response
     */
    public function edit(habilidade $habilidade)
    {
        
        return view('habilidades.edit', compact('habilidade'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\habilidade  $habilidade
     * @return \Illuminate\Http\Response
     */
    public function update(HabilidadeUpdate $request, habilidade $habilidade)
    {
 
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $habilidade->fill($data);
            $habilidade->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('habilidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\habilidade  $habilidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(habilidade $habilidade)
    {        
        try {
            $habilidade->delete();
        } catch (Exception $habilidade) {
            alert()->error('Error', $habilidade->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        return redirect()->route('habilidades.index');

    }
}
