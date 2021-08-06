<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Redireccion al login 

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function(){
    return redirect()->route('login');
});

// Auth
Auth::routes();

Route::group(['middleware' => ['auth', 'check_active']], function(){

    // Home
    Route::get('/home', 'HomeController@index')->name('home');

    // Areas
    Route::resource('areas', 'AreaController')->middleware('check_rol:master|administracion');

    // Proyectos
    Route::resource('proyectos', 'ProyectoController')->middleware('check_rol:master|administracion');

    // Cargos
    Route::resource('cargos', 'CargoController')->middleware('check_rol:master|administracion');

    // Directivos
    Route::resource('directivos', 'DirectivoController')->middleware('check_rol:master|administracion');

    // Estado de Solicitudes
    Route::resource('solicitudes', 'EstadoSolicitudeController')->middleware('check_rol:master');

    // Contratos
    Route::resource('contratos', 'ContratoController')->except(['create'])->middleware('check_rol:master|administracion');

    Route::get('contratos/add/{user}', 'ContratoController@create')->name('contratos.create')->middleware('check_rol:master|administracion');

    Route::get('contratos/usuario/{user_id}', 'ContratoController@listaContrato')->name('contratos.usuario')->middleware('check_rol:master|administracion');

    // Solicitud de Aumentos
    Route::resource('aumentos', 'SolicitudAumentoController');

    Route::get('solicitud_aumento/{slug}', 'SolicitudAumentoController@indexUser')->name('aumentos.user');

    //Rechazar solicitud de aumentos guardando el mensaje de rechazo
    Route::post('rechazaraumentos', 'SolicitudAumentoController@rechazar')->name('aumentos.rechazar')->middleware('check_rol:administracion');

    //aprobar solicitud de aumentos guardando el mensaje de rechazo
    Route::get('aprobar-aumentos/{id}', 'SolicitudAumentoController@aprobar')->name('aumentos.aprobar')->middleware('check_rol:administracion');

    //Descargar PDF de solicitud de aumentos
    Route::get('pdfaumentos/{id}', 'SolicitudAumentoController@downloadPDF')->name('aumentos.downloadPDF');

    // Solicitud de Vacaciones
    Route::resource('vacaciones', 'SolicitudVacacioneController');


    Route::get('solicitud_vacaciones/{slug}', 'SolicitudVacacioneController@indexUser')->name('vacaciones.user');


    //Rechazar solicitud de vacaciones guardando el mensaje de rechazo
    Route::post('rechazarVacaciones', 'SolicitudVacacioneController@rechazar')->name('vacaciones.rechazar')->middleware('check_rol:administracion');

    //aprobar solicitud de vacaciones guardando el mensaje de rechazo
    Route::post('aprobarVacaciones', 'SolicitudVacacioneController@aprobar')->name('vacaciones.aprobar')->middleware('check_rol:administracion');

    //Descargar PDF de solicitud de vacaciones
    Route::get('pdfVacaciones/{id}', 'SolicitudVacacioneController@downloadPDF')->name('vacaciones.downloadPDF');

    // Index de vacaciones por aprobar para jefes de áreas

    Route::get('vacaciones_por_aprobar_jefe_area', 'SolicitudVacacioneController@indexJA')->name('vacaciones.por_aprobar_ja');
    //->middleware('check_rol:jefe-area');

    //Aprobar vacaciones por jefe de area
    Route::get('vacaciones_aprobar_jefe_area/{id}', 'SolicitudVacacioneController@aprobarJA')->name('vacaciones.aprobar_ja');
    //->middleware('check_rol:jefe-area');


    Route::get('diferenciaDias', 'SolicitudVacacioneController@diferenciaDias')->name('diferenciaDias');


    // Configuraciones de sistema
    Route::resource('configuraciones', 'ConfiguracioneController')->middleware('check_rol:master');
    // Infos
    Route::resource('infos', 'InfoController')->middleware('check_rol:master');

    // Experiencia Laborales
    Route::resource('experiencias', 'ExperienciaLaboraleController');

    Route::post('experiencias/register', 'ExperienciaLaboraleController@register')->name('experiencias.register');

    // Participaciones en los Proyectos
    Route::resource('participaciones', 'ParticipacionProyectoController');

    // Habilidades
    Route::resource('habilidades', 'HabilidadeController');

    Route::get('users/deleteHabilidad/{user_id}/{habilidad_id}', 'UserController@deleteHabilidad')->name('users.deleteHabilidad');

    Route::post('users/storeHabilidad', 'UserController@storeHabilidad')->name('users.storeHabilidad');

    // Habilidades Usuarios
    Route::resource('habilidade_usuarios', 'HabilidadeUsuarioController');

    // Certificaciones
    Route::resource('certificaciones', 'CertificacioneController');

    Route::get('users/deleteCertificaciones/{user_id}/{certificacione_id}', 'UserController@deleteCertificacion')->name('users.deleteCertificacion');

    Route::post('users/storeCertificaciones', 'UserController@storeCertificacion')->name('users.storeCertificacion');

    Route::get('users/pdfCertificadoAntiguedad/{user}', 'UserController@pdfCertificadoAntiguedad')->name('users.pdfCertificadoAntiguedad');

    // Certificaciones Usuarios
    Route::resource('certificacione_usuarios', 'CertificacioneUsuarioController');

    // Titulos
    Route::resource('titulos', 'TituloController');

    Route::get('users/deleteTitulo/{user_id}/{titulo_id}', 'UserController@deleteTitulo')->name('users.deleteTitulo');

    Route::post('users/storeTitulo', 'UserController@storeTitulo')->name('users.storeTitulo');

    Route::get('users/directorio', 'UserController@directorio')->name('users.directorio');


    // Titulos Usuarios
    Route::resource('titulo_usuarios', 'TituloUsuarioController');

    //Usuarios
    Route::resource('users', 'UserController')->except(['show', 'edit', 'update'])->middleware('check_rol:master|administracion');

    Route::get('user/perfil/{slug}', 'UserController@show')->name('users.show');

    Route::get('user/edit/{slug}', 'UserController@edit')->name('users.edit');

    Route::patch('user/update/{id}', 'UserController@update')->name('users.update');


    //Anexos de Contratos

    Route::resource('anexos', 'AnexoController')->except(['create'])->middleware('check_rol:master|administracion');

    Route::get('anexos/add/{contrato_id}', 'AnexoController@create')->name('anexos.add')->middleware('check_rol:master|administracion');

    Route::get('noticias/show', 'HomeController@showNoticias')->name('noticias.show');


    Route::resource('noticias', 'NoticiaController')->except('show')->middleware('check_rol:master|administracion');

    Route::get('noticias/{slug}', 'NoticiaController@show')->name('noticias.show');

    Route::get('user/crear_firma', 'UserController@crearFirma')->name('user.crearFirma');

    Route::post('user/guardar_firma', 'UserController@guardarFirma')->name('user.guardarFirma');

    Route::get('jefes_areas', 'UserController@jefesAreas')->name('user.jefesAreas');

    Route::get('jefes_areas/delete/{id}', 'UserController@deleteJefesAreas')->name('user.deleteJefesAreas')->middleware('check_rol:master|administracion');

});

 //API
 Route::get('api/getCumpleMes/{mes}', 'UserController@getCumpleMes')->name('user.getCumpleMes');
