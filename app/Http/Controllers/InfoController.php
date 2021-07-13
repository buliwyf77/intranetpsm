<?php

namespace App\Http\Controllers;

use App\EstadoSolicitude;
use App\SolicitudVacacione;
use App\SolicitudAumento;
use App\Directivo;
use App\User;
use App\Info;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\InfoStore;
use App\Http\Requests\InfoUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;




class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = Info::all();
        return view('infos.index', compact('infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');     
        $infos = Info::all();
        return view('infos.create',compact('infos', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InfoStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
        //dd($data);  
        try {

        Info::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();
    
        return redirect()->route('infos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {        
        return view('infos.show', compact('info'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {        
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');     
        return view('infos.edit', compact('info', 'user'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(InfoUpdate $request, Info $info)
    {
        
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $info->fill($data);
            $info->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('infos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {        
        try {
       
            $info->delete();
        } catch (Exception $info) {
            alert()->error('Error', $info->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
    }
    return redirect()->route('infos.index');

    }
}
