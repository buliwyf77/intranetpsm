<?php

namespace App\Http\Controllers;

use App\Configuracione;
use Illuminate\Http\Request;
use App\Http\Requests\ConfiguracionStore;
use Illuminate\Support\Facades\DB;

use Alert;
use Illuminate\Support\Facades\Storage;

class ConfiguracioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuraciones = Configuracione::all();
        return $configuraciones;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuraciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfiguracionStore $request)
    {
        $data = $request->all();
        Configuracione::create($data);
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Configuracione  $configuracione
     * @return \Illuminate\Http\Response
     */
    public function show(Configuracione $configuracione)
    {
        return view('configuraciones.show', compact ('configuracione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuracione  $configuracione
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuracione $configuracione)
    {
        return view('configuraciones.edit', compact('configuracione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuracione  $configuracione
     * @return \Illuminate\Http\Response
     */
    public function update(ConfiguracionStore $request, Configuracione $configuracione)
    {
        $data = $request->all();
    
        DB::beginTransaction();

        if ($request->hasFile('logo')) {
            $storage = Storage::disk('s3')->put('config', $data['logo']);
            $data['logo'] = 'https://intranet1.s3-sa-east-1.amazonaws.com/'. $storage;
        }

        
        try {            
            $configuracione->fill($data);
            $configuracione->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('configuraciones.show', $configuracione->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Configuracione  $configuracione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuracione $configuracione)
    {
        //
    }
}
