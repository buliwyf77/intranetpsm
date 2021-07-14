<?php

namespace App\Http\Controllers;

use App\EstadoSolicitude;
use App\SolicitudVacacione;
use App\SolicitudAumento;
use App\Directivo;
use App\User;
use App\Configuracione;
use App\Contrato;
use App\Info;
use App\JefeArea;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\SolicitudVacacioneStore;
use App\Http\Requests\SolicitudVacacioneUpdate;

use Carbon\Carbon;
use Alert;
use App\HistoricoVacacione;
use PDF;
use DataTables;
use Auth;
use PhpParser\Node\Stmt\Foreach_;

class SolicitudVacacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacacione = SolicitudVacacione::orderBy('id', 'DESC')->get(); 
       
        return view('vacaciones.index', compact('vacacione'));
    }


    // Ver Solicitudes propias
    public function indexUser($slug)
    {
        $user = User::where('slug', $slug)->first();
        $vacacione = SolicitudVacacione::where('user_id', $user->id)->orderBy('id', 'DESC')->get(); 
       
        return view('vacaciones.index', compact('vacacione'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');        
        $solicitudes = EstadoSolicitude::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $vacacione = SolicitudVacacione::all();      
        return view('vacaciones.create',compact('vacacione', 'user', 'solicitudes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitudVacacioneStore $request)
    {
        
        DB::beginTransaction();
        
        $data = $request->all();        
        $data['solicitud_id'] = 3;
        $data['user_id'] = Auth::id();
        $data['de_acuerdo'] = 1;
        
        dd($data);
        try {

        $solicitud_vacacion = SolicitudVacacione::create($data);
        HistoricoVacacione::actualizarHistorico($solicitud_vacacion->id, 3);
       
        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();
        
        $rol = Auth::user()->role_id;
        
        if($rol == 2)
        {
            return redirect()->route('vacaciones.user', Auth::user()->slug);
        } else{
            return redirect()->route('vacaciones.index');
        }
    }

       

    /**
     * Display the specified resource.
     *
     * @param  \App\solicitudVacacione  $vacacione
     * @return \Illuminate\Http\Response
     */
    public function show(SolicitudVacacione $vacacione)
    {        
        $historico_vacaciones = HistoricoVacacione::where('solicitud_vacacione_id', $vacacione->id)->orderBy('id', 'DESC')->get();
        
        $n = count($historico_vacaciones);
        
        foreach ($historico_vacaciones as $key => $value) {
            $value['order'] = $n-$key;
        }

        return view('vacaciones.show', compact('vacacione', 'historico_vacaciones'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\solicitudVacacione  $vacacione
     * @return \Illuminate\Http\Response
     */
    public function edit(SolicitudVacacione $vacacione)
    {        
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $solicitudes = EstadoSolicitude::orderBy('nombre', 'ASC')->pluck('nombre', 'id');        
        return view('vacaciones.edit', compact('vacacione', 'user', 'solicitudes'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\solicitudVacacione  $vacacione
     * @return \Illuminate\Http\Response
     */
    public function update(SolicitudVacacioneUpdate $request, SolicitudVacacione $vacacione)
    {
        
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $vacacione->fill($data);
            $vacacione->save();
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        $rol = Auth::user()->role_id;
        
        if($rol == 2)
        {
            return redirect()->route('vacaciones.user', Auth::user()->slug);
        } else{
            return redirect()->route('vacaciones.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\solicitudVacacione  $vacacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(SolicitudVacacione $vacacione)
    {        
        try {
       
            $vacacione->delete();
        } catch (\Exception $vacacione) {
            alert()->error('Error', $vacacione->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        $rol = Auth::user()->role_id;
        
        if($rol == 2)
        {
            return redirect()->route('vacaciones.user', Auth::user()->slug);
        } else{
            return redirect()->route('vacaciones.index');
        }

    }

    //Método para aprobar vacaciones
    public function aprobar (Request $request)
    {
        //Verificar que se guarde el área al aprobar

        $solicitud_vacacion = SolicitudVacacione::find($request->get('solicitud_vacacione_id'));
        $solicitud_vacacion->update([
            'fecha_ingreso_trabajador'      =>  $request->get('fecha_ingreso_trabajador'),
            'periodo_vacaciones'            =>  $request->get('periodo_vacaciones'),
            'dias_acumulados'               =>  $request->get('dias_acumulados'),
            'fecha_aprobacion'              =>  date('Y-m-d'),
            'solicitud_id'                  =>  1,
            'saldo'                         =>  $request->get('saldo')
        ]);

        HistoricoVacacione::actualizarHistorico($solicitud_vacacion->id, 1);

        //Actualizar estado a espera de aprobación por jefe de área
        HistoricoVacacione::actualizarHistorico($solicitud_vacacion->id, 4);
        $solicitud_vacacion->update(['solicitud_id' => 4]);

        alert()->success('Registro Exitoso','Su registro se ha procesado de manera exitosa')->showConfirmButton();
        return redirect()->route('vacaciones.index');
    }


    //Rechazar vacaciones
    public function rechazar (Request $request)
    {
        //$data = $request->all();
        $solicitud_vacacion = SolicitudVacacione::find($request->get('solicitud_vacacione_id'));
        $solicitud_vacacion->update([
            'mensaje_rechazo'   =>  $request->get('mensaje_rechazo'),
            'fecha_rechazo'     =>  date('Y-m-d'),
            'solicitud_id'      =>  2
        ]);

        HistoricoVacacione::actualizarHistorico($solicitud_vacacion->id, 2, $solicitud_vacacion->mensaje_rechazo);

        alert()->success('Registro Exitoso','Su registro se ha procesado de manera exitosa')->showConfirmButton();
        return redirect()->route('vacaciones.index');    
    }

    //Descargar PDF
    public function downloadPDF ($id)
    {
        $solicitud_vacaciones = SolicitudVacacione::find($id); 

        if(User::verificarFirma($solicitud_vacaciones->user_id))
        {
            $solicitud_vacaciones['cargo_trabajador'] = User::getUserCargo($solicitud_vacaciones->user_id);

            $empresa = Configuracione::empresa();

            $jefe_area = User::with('info')->where(['area_id' => $solicitud_vacaciones->user->area_id, 'role_id' => 5])->first();
            $jefe_area['cargo_trabajador'] = User::getUserCargo($jefe_area->id);

            $pdf = PDF::loadView('vacaciones.pdf', [
                'solicitud_vacaciones'  => $solicitud_vacaciones,
                'empresa'               => $empresa, 
                'jefe_area'             => $jefe_area
            ]);

            return $pdf->download('solicitud_vacaciones_'.date('Y_m_d').'.pdf');
        } else {
            alert()->warning('¡Advertencia!','Debe crear su firma para descargar el documento')->showConfirmButton();
            return redirect()->back();
        }    
      
    }

    // Metodo para mostrar las solicitudes de vacaciones pedientes por aprobación del Jefe de Área
    public function indexJA ()
    {

        //Verificar si es jefe de área
        //User::verifyJefeArea();
        
        $areas = JefeArea::where('user_id', Auth::id())->get(['area_id']);

        $areas_id = array_column($areas->toArray(), 'area_id');

        $vacacione = SolicitudVacacione::whereIn('area_id', $areas_id)
                                        ->where('solicitud_id', 4)
                                        ->orderBy('id', 'DESC')
                                        ->get();
    
        return view('vacaciones.index', compact('vacacione'));
        
    }


    //Método para aprobar vacaciones por jefe de área
    public function aprobarJA ($vacacion_id)
    {
        $solicitud_vacacion = SolicitudVacacione::find($vacacion_id);
        $solicitud_vacacion->update(['solicitud_id' => 5]);

        HistoricoVacacione::actualizarHistorico($solicitud_vacacion->id, 5);

        return redirect()->route('vacaciones.por_aprobar_ja');

    }


}
