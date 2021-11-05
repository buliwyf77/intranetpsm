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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anexo  $anexo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anexo $anexo)
    {
        //
    }
}
