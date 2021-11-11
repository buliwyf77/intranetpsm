<?php

namespace App\Http\Controllers;

use App\Anexo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Contrato;
use App\TipoContrato;
use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Alert;

class AnexoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ejemplo
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($contrato_id)
    {
        $contrato = Contrato::find($contrato_id);
        $tipo_contrato = TipoContrato::pluck('nombre', 'id');
        return view('anexos.create', compact('contrato', 'tipo_contrato'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $contrato = Contrato::find($data['contrato_id']);

            $user = User::find($contrato->user_id);

            if ($request->hasFile('archivo')) {
                $archivo = Storage::disk('s3')->put('anexos/'.$data['fecha'], $data['archivo']);
                $data['archivo'] = 'https://intranet1.s3-sa-east-1.amazonaws.com/' . $archivo;
            }

            Anexo::create($data);

            } catch (\Exception $e) {
                DB::rollBack();
                alert()->error('Error', $e->getMessage())->showConfirmButton();
                return redirect()->back()->withInput();
            }
    
            DB::commit();
            
            alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();
    
            //return redirect()->route('contratos.usuario', $contrato->user_id);

            return redirect()->route('users.show', $user->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anexo  $anexo
     * @return \Illuminate\Http\Response
     */
    public function show(Anexo $anexo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anexo  $anexo
     * @return \Illuminate\Http\Response
     */
    public function edit(Anexo $anexo)
    {
        $tipo_contrato = TipoContrato::pluck('nombre', 'id');
        return view('anexos.edit', compact('tipo_contrato', 'anexo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anexo  $anexo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anexo $anexo)
    {
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {
            
            if ($request->hasFile('archivo')) {
                $archivo = Storage::disk('s3')->put('anexos/'.$data['fecha'], $data['archivo']);
                $data['archivo'] = 'https://intranet1.s3-sa-east-1.amazonaws.com/' . $archivo;
            }

            $anexo->fill($data);
            $anexo->save();

        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('users.show', $anexo->contrato->user->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anexo  $anexo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anexo $anexo)
    {
        $user = User::find($anexo->contrato->user_id);
        
        try {
            $anexo->delete();
        } catch (Exception $anexo) {
            alert()->error('Error', $anexo->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        //return redirect()->route('anexos.index');
        return redirect()->route('users.show', $user->slug);
    }
}
