<?php

namespace App\Http\Controllers;

use App\EstadoSolicitude;
use App\SolicitudVacacione;
use App\SolicitudAumento;
use App\Directivo;
use App\User;
use App\Configuracione;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\SolicitudAumentoStore;
use App\Http\Requests\SolicitudAumentoUpdate;

use Carbon\Carbon;
use Alert;
use App\HistoricoAumento;
use PDF;
use DataTables;
use Auth;




class SolicitudAumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aumento = SolicitudAumento::orderBy('id', 'DESC')->get();
        return view('aumentos.index', compact('aumento'));
    }

    public function indexUser($slug)
    {
        $user = User::where('slug', $slug)->first();
        $aumento = SolicitudAumento::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        return view('aumentos.index', compact('aumento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aumentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitudAumentoStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();          
        //$data['solicitud_id'] = 3;
        $data['user_id'] = Auth::id();
        $data['fecha'] = date('Y-m-d');
        $data['solicitud_id'] = 3;
     
        try {

        $aumento = SolicitudAumento::create($data);

        HistoricoAumento::actualizarHistorico($aumento->id, $aumento->solicitud_id);

        } catch (\Exception $e) {
        
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();
        
        return redirect()->route('aumentos.user', Auth::user()->slug);
  
        /*$rol = Auth::user()->role_id;
        
        if($rol == 2)
        {
            return redirect()->route('aumentos.user', Auth::user()->slug);
        } else{
            return redirect()->route('aumentos.index');
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\solicitudAumento  $aumento
     * @return \Illuminate\Http\Response
     */
    public function show(SolicitudAumento $aumento)
    {   
        $historico_aumentos = HistoricoAumento::where('solicitud_aumento_id', $aumento->id)->orderBy('id', 'DESC')->get();
        $n = count($historico_aumentos);
        
        foreach ($historico_aumentos as $key => $value) {
            $value['order'] = $n-$key;
        }

        return view('aumentos.show', compact('aumento', 'historico_aumentos'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\solicitudAumento  $aumento
     * @return \Illuminate\Http\Response
     */
    public function edit(SolicitudAumento $aumento)
    {        
        $user = User::orderBy('name', 'ASC')->pluck('name', 'id');
        $directivo = Directivo::orderBy('nombre_completo', 'ASC')->pluck('nombre_completo', 'id');
        $solicitudes = EstadoSolicitude::orderBy('nombre', 'ASC')->pluck('nombre', 'id');        
        return view('aumentos.edit', compact('aumento', 'user', 'directivo', 'solicitudes'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\solicitudAumento  $aumento
     * @return \Illuminate\Http\Response
     */
    public function update(SolicitudAumentoUpdate $request, SolicitudAumento $aumento)
    {
        
        $data = $request->all();
    
        DB::beginTransaction();
        
        try {            
            $aumento->fill($data);
            $aumento->save();
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
            return redirect()->route('aumentos.user', Auth::user()->slug);
        } else{
            return redirect()->route('aumentos.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\solicitudAumento  $aumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(SolicitudAumento $aumento)
    {        
        try {
       
            $aumento->delete();
        } catch (\Exception $aumento) {
            alert()->error('Error', $aumento->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        $rol = Auth::user()->role_id;
        
        if($rol == 2)
        {
            return redirect()->route('aumentos.user', Auth::user()->slug);
        } else{
            return redirect()->route('aumentos.index');
        }

    }
    //Método para aprobar aumentos
    public function aprobar ($solicitud_aumento_id)
    {   //dd($solicitud_aumento_id);
        $solicitud_aumentos = SolicitudAumento::find($solicitud_aumento_id);
        $solicitud_aumentos->update([
                'solicitud_id'                  =>  1
        ]);

        HistoricoAumento::actualizarHistorico($solicitud_aumento_id, $solicitud_aumentos->solicitud_id);

        alert()->success('Registro Exitoso','Su registro se ha procesado de manera exitosa')->showConfirmButton();
        return redirect()->route('aumentos.index');
    }


    //Rechazar aumeto
    public function rechazar (Request $request)
    {
        //ss$data = $request->all();
        //dd($data);
        $solicitud_aumento = SolicitudAumento::find($request->get('solicitud_aumento_id'));
        $solicitud_aumento->update([
           'solicitud_id'      =>  2
        ]);

        HistoricoAumento::actualizarHistorico($solicitud_aumento->id, $solicitud_aumento->solicitud_id, $request->get('mensaje_rechazo'));

        alert()->success('Registro Exitoso','Su registro se ha procesado de manera exitosa')->showConfirmButton();
        return redirect()->route('aumentos.index');    
    }

    //Descargar PDF
    public function downloadPDF ($id)
    {
        $solicitud_aumento = SolicitudAumento::find($id);

        if(User::verificarFirma($solicitud_aumento->user_id))
        {
            $solicitud_aumento['cargo_trabajador'] = User::getUserCargo($solicitud_aumento->user_id);
            $user = User::where('id', $solicitud_aumento->user_id)->first();
            
            $jefe_aprueba = User::find(37);
            
            $empresa = Configuracione::empresa();
            $pdf = PDF::loadView('aumentos.pdf', ['aumento' => $solicitud_aumento, 'empresa' => $empresa, 
                                'user' => $user, 'jefe_aprueba' => 'jefe_aprueba']);
            return $pdf->download('solicitud_aumentos_'.date('Y_m_d').'.pdf');
        } else {
            alert()->warning('¡Advertencia!','Debe crear su firma para descargar el documento')->showConfirmButton();
            return redirect()->back();
        }    
    }
}
