<?php

namespace App\Http\Controllers;
use App\User;
use App\Usuario;
use App\Role;
use App\Area;
use App\EstadoSolicitude;
use App\SolicitudAumento;
use App\SolicitudVacacione;
use App\Proyecto;
use App\Cargo;
use App\Contrato;
use App\Info;
use App\Titulo;
use App\Certificacione;
use App\Configuracione;
use App\Habilidade;
use App\JefeArea;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;


use Carbon\Carbon;
use Alert;
use PDF;
use DataTables;
use Auth;
use Image;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();             
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = Area::orderBy('nombre', 'ASC')->pluck('nombre', 'id');     
        return view('users.create', compact('area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStore $request)
    {
        DB::beginTransaction();
        
        $data = $request->all();

        $user = [
            'name'  => $data['name'],
            'email' => $data['email'],
            'password'  => bcrypt($data['password']),
            'role_id' => 2,
            'slug' => Str::slug($data['name'], '-'),
            'area_id'   =>  $data['area_id'],
            'jefe_area' => isset($data['jefe_area']) ? true : false,
        ];
        
        $imagen = 'https://intranet1.s3-sa-east-1.amazonaws.com/config/user.png';
        
        if ($request->hasFile('imagen')) {
            //$img = Image::make($data['image'])->resize(300, 200);
            $imagen = Storage::disk('s3')->put('users-profiles', $data['imagen']);
            $imagen = 'https://intranet1.s3-sa-east-1.amazonaws.com/' . $imagen;
        }

        try {

        $new_user = User::create($user);

        $info = [
            'fecha_nacimiento'  => $data['fecha_nacimiento'],
            'fecha_ingreso'     => $data['fecha_ingreso'],
            'nacionalidad'      => $data['nacionalidad'],
            'doc_identidad'     => $data['doc_identidad'],
            'num_doc'           => $data['num_doc'],
            'direccion'         => $data['direccion'],
            'telefono'          => $data['telefono'],
            'imagen'            => $imagen,
            'area_id'           => $data['area_id'],
            'user_id'           => $new_user->id
        ];

        if ($new_user) {
            $new_info = Info::create($info);
        }

        //Registrar áreas si el usuario es jefe de área
        if(isset($data['jefe_area'])){
            foreach ($data['areas'] as $key => $area_id) {
                JefeArea::register($new_user->id, $area_id);
            }
        }
           
        
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage())->showConfirmButton();
            return redirect()->back()->withInput();
        }

        DB::commit();
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();

        //return redirect()->route('contratos.create', $new_user->id);
        return redirect()->route('users.show', $new_user->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {   
        $user = User::where('slug', $slug)->first();
        
        if ($user != null) {
            $verifyAccess = User::getUserAuthorized($user->id);

            if ($verifyAccess) {
                $habilidades = Habilidade::orderBy('nombre', 'DESC')->pluck('nombre', 'id');
                $titulos = Titulo::orderBy('nombre', 'DESC')->pluck('nombre', 'id');
                $certificaciones = Certificacione::orderBy('nombre', 'DESC')->pluck('nombre', 'id');
                $proyectos = Proyecto::orderBy('nombre', 'DESC')->pluck('nombre', 'id');
                $vacaciones = SolicitudVacacione::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
                $aumentos = SolicitudAumento::where('user_id', $user->id)->orderBy('id', 'DESC')->get();

                return view('users.show', compact('user', 'habilidades', 'titulos', 'certificaciones',
                                                'proyectos', 'vacaciones', 'aumentos'));
            } else{
                abort(403);
            }
        } else{
            abort(404);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user_slug)
    {
        $user = User::where('slug', $user_slug)->first();

        $verifyAccess = User::getUserAuthorized($user->id);

        if ($verifyAccess) {
            $area = Area::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
            return view('users.edit', compact('user', 'area')); 
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdate $request, $user_id)
    {
        $user = User::find($user_id);

        $verifyAccess = User::getUserAuthorized($user->id);

        if ($verifyAccess) {

            $data = $request->all();

            $info = Info::where('user_id', $user->id)->first();
        
            DB::beginTransaction();
            
            try {
                $data['password'] = bcrypt($data['password']);
                $user->fill($data);
                $user->save();

                $imagen = $info->imagen;
                if(isset($data['imagen']) && ($data['imagen'] != null)) {                
                    Storage::disk('s3')->delete('users-profiles/' . $user->image);
                    //&& Image::make($data)->resize(300, 200);                 
                    $imagen = Storage::disk('s3')->put('users-profiles', $data['imagen']);
                    $imagen = 'https://intranet1.s3-sa-east-1.amazonaws.com/' . $imagen;
                }

                $infoUpdate = [
                    'fecha_nacimiento'  => $data['fecha_nacimiento'],
                    'fecha_ingreso'     => $data['fecha_ingreso'],
                    'nacionalidad'      => $data['nacionalidad'],
                    'doc_identidad'     => $data['doc_identidad'],
                    'num_doc'           => $data['num_doc'],
                    'direccion'         => $data['direccion'],
                    'telefono'          => $data['telefono'],
                    'imagen'            => $imagen,
                    'area_id'           => $data['area_id']
                ]; 

                $info = Info::where('user_id', $user->id)->first();

                $info->update($infoUpdate);
                
            } catch (\Exception $e) {
                DB::rollBack();
                alert()->error('Error', $e->getMessage());
                return redirect()->back()->withInput();
            }

            DB::commit();

            alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa')->showConfirmButton();
            
            return redirect()->route('users.show', $user->slug);

        }else{

            abort(403);

        }

        /*if(Auth::User()->role_id == 1){
            return redirect()->route('users.index');
        }else{
            return redirect()->route('users.show', $user->id);
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
       $user = User::find($id);
       $user->delete();
        return back()->with('notification', 'El usuario se ha dado de baja correctamente');
    }

    public function destroy(User $user)
    {
        try {
       
            $user->delete();
        } catch (\Exception $user) {
            alert()->error('Error', $user->getMessage())->showCloseButton()->showConfirmButton();
            return redirect()->back();
        }
        return redirect()->route('users.index');
    }


    //Eliminar registro en tabla join habilidad_user
    public function deleteHabilidad ($user_id, $habilidad_id)
    {
        $user = User::find($user_id);
        $user->habilidades()->detach($habilidad_id);
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa');
        return redirect()->route('users.show', $user->slug);
    }

    //Agregar registro en tabla join habilidad_user
    public function storeHabilidad (Request $request)
    {
        $data = $request->all();
        $user = User::find($data['user_id']);
        $user->habilidades()->attach($data['habilidade_id']);
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa');
        return redirect()->route('users.show', $user->slug);
    }


    //Eliminar registro en tabla join titulo_user
    public function deleteTitulo ($user_id, $titulo_id)
    {
        $user = User::find($user_id);
        $user->titulos()->detach($titulo_id);
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa');
        return redirect()->route('users.show', $user->slug);
    }

    //Agregar registro en tabla join titulo_user
    public function storeTitulo (Request $request)
    {
        $data = $request->all();
        $user = User::find($data['user_id']);
        $user->titulos()->attach($data['titulo_id']);
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa');
        return redirect()->route('users.show', $user->slug);
    }


    //Eliminar registro en tabla join certificacion_user
    public function deleteCertificacion ($user_id, $certificacion_id)
    {
        $user = User::find($user_id);
        $user->certificaciones()->detach($certificacion_id);
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa');
        return redirect()->route('users.show', $user->slug);
    }

    //Agregar registro en tabla join certificacion_user
    public function storeCertificacion (Request $request)
    {
        $data = $request->all();
        $user = User::find($data['user_id']);
        $user->certificaciones()->attach($data['certificacione_id']);
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa');
        return redirect()->route('users.show', $user->slug);
    }


    //Descargar PDF de certificado de antiguedad
    public function pdfCertificadoAntiguedad (User $user)
    {
        $empresa = Configuracione::empresa();
        $contrato = Contrato::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        $pdf = PDF::loadView('users.certificado-antiguedad-pdf', ['user' => $user, 'empresa' => $empresa, 'contrato' => $contrato]);
        return $pdf->download('certificado_antiguedad_'.date('Y_m_d').'.pdf');
    }

    //Ditectorio de Trabajadores
    public function directorio(){
        $users = User::orderBy('name', 'ASC')->get();
        return view('users.directorio', compact('users'));
    }

    //Formulario para Crear Firma de Usuario
    public function crearFirma () 
    {
        return view('users.crear_firma');
    }

    //Metodo para Guardar la Firma del USuario
    public function guardarFirma (Request $request)
    {
        $img = $request->get('firma');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        
        $data = base64_decode($img);
        $imageName = Str::random(20).'.'.'png';
        $imagen = Storage::disk('s3')->put('users-firmas/'.$imageName, $data);
        $firma = 'https://intranet1.s3-sa-east-1.amazonaws.com/users-firmas/'.$imageName;

        $user_id = Auth::id();
        $user = Auth::user();
        $info = Info::where('user_id', $user_id)->first();
        $info->update(['firma' => $firma]);
        
        alert()->success('Registro Exitoso','El registro se ha procesado de manera exitosa');
        return redirect()->route('users.show', $user->slug);

    }

    //Método para crear una index con los jefes de áreas
    public function jefesAreas ()
    {
        $jefes_areas = JefeArea::all();
        return view('users.jefes_areas', compact('jefes_areas'));
    }

    //Método para eliminar a los registros de jefes de áreas - áreas
    public function deleteJefesAreas ($id)
    {
        $jefe_area = JefeArea::find($id);

        $jefe_area->delete();

        alert()->success('Registro Eliminado', 'El registro se ha borrado correctamente')->showCloseButton()->showConfirmButton();
        
        return redirect()->back();
    }


    //Api para recibir las fechas de los cumpleañeros del mes
    public function getCumpleMes($mes)
    {
        return json_encode(User::cumpleMes($mes), true);
    }


}
