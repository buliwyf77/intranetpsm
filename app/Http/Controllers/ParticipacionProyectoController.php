<?php

namespace App\Http\Controllers;

use App\Proyecto;
use App\Area;
use App\User;
use App\ParticipacionProyecto;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ParticipacionProyectoStore;
use App\Http\Requests\ParticipacionProyectoUpdate;

use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;

class ParticipacionProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participacione = ParticipacionProyecto::all();
       
        return view('participaciones.index', compact('participacione'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        $proyectos = Proyecto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('participaciones.create',compact('proyectos', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipacionProyectoStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
                
        try {

        $participacion_proyecto = ParticipacionProyecto::create($data);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        return redirect()->route('users.show', $participacion_proyecto->user->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\participacione  $participacione
     * @return \Illuminate\Http\Response
     */
    public function show(ParticipacionProyecto $participacione)
    {
        return view('participaciones.show', compact('participacione')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\participacione  $participacione
     * @return \Illuminate\Http\Response
     */
    public function edit(ParticipacionProyecto $participacione)
    {
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $proyecto = Proyecto::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        return view('participaciones.edit', compact('participacione','user', 'proyecto')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\participacione  $participacione
     * @return \Illuminate\Http\Response
     */
    public function update(ParticipacionProyectoUpdate $request, ParticipacionProyecto $participacione)
    {
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $participacione->fill($data);
            $participacione->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa');

        return redirect()->route('users.show', $participacione->user->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\participacione  $participacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParticipacionProyecto $participacione)
    {
        try {
       
            $participacione->delete();
        } catch (Exception $participacione) {
            alert()->error('Error', $participacione->getMessage())->showCloseButton();
            return redirect()->back();
        }

        alert()->success('Registro Eliminado!','El registro se ha procesado de manera exitosa');
        
        return redirect()->route('users.show', $participacione->user->slug);
    }
}
