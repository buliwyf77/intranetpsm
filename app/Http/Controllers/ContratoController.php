<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\TipoContrato;
use App\Cargo;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ContratoStore;
use App\Http\Requests\ContratoUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrato = Contrato::all();
        $user = User::all();
        $cargo = Cargo::all();
        return view('contratos.index', compact('contrato', 'user', 'cargo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $cargo = Cargo::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $tipo_contrato = TipoContrato::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('contratos.create',compact('user', 'cargo', 'tipo_contrato'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratoStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
        
        $user = User::find($data['user_id']);
        
        if ($request->hasFile('archivo')) {
            $archivo = Storage::disk('s3')->put('contratos/'.Str::slug($user->name, '-'), $data['archivo']);
            $data['archivo'] = 'https://intranet1.s3-sa-east-1.amazonaws.com/' . $archivo;
        }

        try {

        Contrato::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        //return redirect()->route('contratos.index');
        
        return redirect()->route('users.show', $user->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        return view('contratos.show', compact('contrato')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $contrato)
    {
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $cargo = Cargo::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $tipo_contrato = TipoContrato::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('contratos.edit', compact('contrato','user', 'cargo', 'tipo_contrato')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(ContratoUpdate $request, Contrato $contrato)
    {
        $data = $request->all();
        
        $user = User::find($contrato->user_id);
    
        DB::beginTransaction();
        
        try {            
            $contrato->fill($data);
            $contrato->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        //return redirect()->route('contratos.index');
        return redirect()->route('users.show', $user->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $contrato)
    {
        $user = User::find($contrato->user_id);
        
        try {
            $contrato->delete();
        } catch (Exception $contrato) {
            alert()->error('Error', $contrato->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        //return redirect()->route('contratos.index');
        return redirect()->route('users.show', $user->slug);
    }

    //Lista de Contratos por Usuarios
    public function listaContrato ($user_id)
    {
       $user = User::with('contratos')->find($user_id);
        return view('contratos.lista-contratos', compact('user'));
     }
}
