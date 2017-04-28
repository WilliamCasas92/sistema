<?php
use Carbon\Carbon;

//Ruta Inicio
Route::get('/', function () {
    return view('welcome');
});

//Rutas LogIn LogOut
Auth::routes();

//Rutas Google
Route::get('social/google', 'SocialController@getSocialAuth');
Route::get('social/callback/google', 'SocialController@getSocialAuthCallback');

//Rutas ADMINISTRADOR
Route::group(['middleware' => 'onlyAdmin'], function() {
    //Rutas Usuarios
    Route::resource('users', 'UserController');
    Route::post('filtrarusuarios', ['as'=>'filtrar.usuario','uses'=> 'UserController@search']);
    //Rutas TipoProceso
    Route::resource('tipoproceso', 'TipoProcesoController');
    //Rutas Etapa
    Route::get('etapa/{et1}', ['as'=>'etapa.almacenar','uses'=> 'EtapaController@almacenar']);
    Route::put('etapa/subir/{etapa_id}', ['as'=>'etapa.subirEtapa','uses'=> 'EtapaController@subir_etapa']);
    Route::put('etapa/bajar/{etapa_id}', ['as'=>'etapa.bajarEtapa','uses'=> 'EtapaController@bajar_etapa']);
    Route::resource('etapa', 'EtapaController');
    //Rutas Requisitos
    Route::get('requisito/{req1}', ['as'=>'requisito.almacenar','uses'=> 'RequisitoController@almacenar']);
    Route::post('requisito/{requisito}', ['as'=>'requisito.guardar','uses'=> 'RequisitoController@guardar']);
    Route::resource('requisito', 'RequisitoController');
    //Ruta Indicadores
    Route::resource('indicadores', 'IndicadoresController');
});

//Rutas SOLO ADMIN Y COORDINADOR
Route::group(['middleware' => 'onlyAdminCoordinador'], function() {
    //Ruta Historial
    Route::get('procesocontractual/historial/{proceso_id}', ['as'=>'historiales.mostrar','uses'=> 'HistorialController@mostrar']);
});


//Rutas DILIGENCIAR
Route::group(['middleware' => 'onlyDiligenciar'], function() {
    //Rutas Procesos Contractuales
    Route::get('procesocontractual/enviar/{idproceso}', ['as'=>'procesocontractual.enviar','uses'=> 'ProcesoContractualController@enviar']);
    Route::get('procesocontractual/recibir/{idproceso}', ['as'=>'procesocontractual.recibir','uses'=> 'ProcesoContractualController@recibir']);
    Route::get('procesocontractual/finalizar/{idproceso}/{idetapa}', ['as'=>'procesocontractual.finalizar','uses'=> 'ProcesoContractualController@finalizar']);
    Route::get('procesocontractual/desertar/{idproceso}', ['as'=>'procesocontractual.desertar','uses'=> 'ProcesoContractualController@desertar']);
    Route::get('procesocontractual/reanudar/{idproceso}', ['as'=>'procesocontractual.reanudar','uses'=> 'ProcesoContractualController@reanudar']);
    Route::resource('procesocontractual', 'ProcesoContractualController');
    //Rutas Datos Etapas
    Route::get('datosetapas/enviar/{idproceso}/{idetapa}', ['as'=>'datosetapas.enviaretapa','uses'=> 'DatosEtapaController@enviar_etapa']);
    Route::get('datosetapas/{datoetapa}', ['as'=>'datosetapas.menu','uses'=> 'DatosEtapaController@menu']);
    Route::resource('datosetapas', 'DatosEtapaController');
    //Rutas de Datos Etapas para subir y eliminar documentos
    Route::post('datosetapas/documento', ['as'=>'datosetapas.subirDocumento','uses'=> 'DatosEtapaController@subir_documento']);
    Route::post('datosetapas/documento/{idproceso}/{idrequisito}', ['as'=>'datosetapas.eliminarDocumento','uses'=> 'DatosEtapaController@eliminar_documento']);
    //Rutas de Documentos
    Route::get('datosetapas/correo/correo', ['as'=>'datosetapas.correo','uses'=> 'DatosEtapaController@correo']);
    //Rutas de observaciones
    Route::resource('observacion', 'ObservacionesController');
});

Route::group(['middleware' => 'allUsers'], function() {
    //Rutas Consulta de procesos
    Route::get('consultaproceso', ['as'=>'consulta.mostrar','uses'=> 'ConsultasController@mostrar']);
    Route::get('consultaproceso/{idproceso}', ['as'=>'consulta.consultavermas','uses'=> 'ConsultasController@ver_mas']);
    //App Home
    Route::get('/home', 'HomeController@index');
    //Ruta Home
    Route::get('home', function () {
        return view('home');
    });
    //Ruta Acerca
    Route::get('acerca', 'HomeController@about');
});
