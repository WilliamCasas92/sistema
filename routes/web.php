<?php
use Carbon\Carbon;

//Ruta Inicio
Route::get('/', function () {
    return view('welcome');
});

//Ruta Home
Route::get('home', function () {
    return view('home');
});

//Rutas LogIn LogOut
Auth::routes();
Route::get('/home', 'HomeController@index');

//Rutas Google
Route::get('social/google', 'SocialController@getSocialAuth');
Route::get('social/callback/google', 'SocialController@getSocialAuthCallback');

//Rutas Administrador
Route::group(['middleware' => 'onlyAdmin'], function() {
    //Rutas Usuarios
    Route::resource('users', 'UserController');
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


Route::group(['middleware' => 'onlyDiligenciar'], function() {
    //Rutas Procesos Contractuales
    Route::get('procesocontractual/enviar/{idproceso}', ['as'=>'procesocontractual.enviar','uses'=> 'ProcesoContractualController@enviar']);
    Route::get('procesocontractual/recibir/{idproceso}', ['as'=>'procesocontractual.recibir','uses'=> 'ProcesoContractualController@recibir']);
    //Desglosar
    Route::resource('procesocontractual', 'ProcesoContractualController');
    //Rutas Datos Etapas
    Route::get('datosetapas/enviar/{idproceso}/{idetapa}', ['as'=>'datosetapas.enviaretapa','uses'=> 'DatosEtapaController@enviar_etapa']);

    Route::get('datosetapas/{datoetapa}', ['as'=>'datosetapas.menu','uses'=> 'DatosEtapaController@menu']);

    Route::resource('datosetapas', 'DatosEtapaController');
    //Rutas de Datos Etapas para subir y eliminar documentos
    Route::post('datosetapas/documento', ['as'=>'datosetapas.subirDocumento','uses'=> 'DatosEtapaController@subir_documento']);
    Route::post('datosetapas/documento/{idproceso}/{idrequisito}', ['as'=>'datosetapas.eliminarDocumento','uses'=> 'DatosEtapaController@eliminar_documento']);
});


//Rutas Consulta de procesos
Route::get('consultaproceso', ['as'=>'consulta.mostrar','uses'=> 'ConsultasController@mostrar']);
Route::get('consultaproceso/{idproceso}', ['as'=>'consulta.consultavermas','uses'=> 'ConsultasController@ver_mas']);


//TESTS
Route::get('test1', function (){
    $etapas=App\Etapa::all();
    foreach ($etapas as $etapa){
        //$proceso= App\TipoProceso::find($etapa->tipo_procesos_id);
        echo $etapa->nombre." del proceso: ". $etapa->tipo_procesos->nombre ."<br/>" ;
    }
});

Route::get('test2', function (){
    $reqs=App\Requisito::all();
    foreach ($reqs as $req){
        //$proceso= App\TipoProceso::find($etapa->tipo_procesos_id);
        echo $req->etapas->nombre . " CONTIENE EL REQUISITO: " . $req->nombre." DEL TIPO: "
            . $req->tipo_requisitos->nombre . "<br/>";
    }
});

Route::get('test3', function (){
    $usuarios=App\User::all();
    echo $usuarios. " <br/>";
});

Route::get('test4', function (){
    $etapas=App\Etapa::where('tipo_procesos_id', 1)->get();
    foreach ($etapas as $etapa){
        echo $etapa->nombre." del proceso: ". $etapa->tipo_procesos->nombre ."<br/><br/>";
        $reqs=App\Requisito::all();
        foreach ($reqs as $req){
            if ($req->etapas_id==$etapa->id){
                echo $req->nombre."<br/>";
                $tipo_reqs=App\TipoRequisito::find($req->tipo_requisitos_id);
                echo $tipo_reqs->nombre."<br/>";
            }
            echo "<br/>";
        }
    }
});

Route::get('test5', function (){
    $datos = DB::table('dato_etapas')
        ->where('proceso_contractual_id', 1)
        ->join('requisitos', function ($join) {
            $join->on('dato_etapas.requisitos_id', '=', 'requisitos.id')
                ->where('requisitos.etapas_id', '=', 1);
        })
        ->get();

    $test= DB::table('dato_etapas')->where('proceso_contractual_id', 1)->get();

    if ($datos->count()){
        foreach ($datos as $dato){
            if (($dato->obligatorio=='1') &&
                ( ($dato->valor=='')||($dato->valor=='0') )){
                echo 'El campo '.$dato->nombre. ' es obligatorio';
            }
        }
    }else{
        echo 'no existen datos';
    }
});



Route::get('test6', function (){

    $tipos_procesos=\App\TipoProceso::where('activo',1)->get();
    //Datos del proceso
    foreach ($tipos_procesos as $tipo_proceso){
        echo "Nombre del proceso: ".$tipo_proceso->nombre;
        $cantidadProcesos = DB::table('proceso_contractuals')->where('tipo_proceso', $tipo_proceso->nombre)->count();
        echo "<br> Cantidad de procesos almacenados: ".$cantidadProcesos;
        echo "<br>";

        $cantidadProcesosSinEnviar = DB::table('proceso_contractuals')
                        ->where('tipo_proceso', $tipo_proceso->nombre)
                        ->Where('estado','Sin enviar al Área de Adquisiciones.')
                        ->count();

        echo "<br> Cantidad de procesos sin enviar a Adquisiciones: ".$cantidadProcesosSinEnviar;
        echo "<br>";

        $cantidadProcesosEnviados = DB::table('proceso_contractuals')
                        ->where('tipo_proceso', $tipo_proceso->nombre)
                        ->Where('estado','Enviado al Área de Adquisiciones.')
                        ->count();
        echo "<br> Cantidad de procesos esperando ser recibidos en Adquisiciones: ".$cantidadProcesosEnviados;

        echo "<br>";
        $proceso_contractual = \App\ProcesoContractual::where('tipo_proceso', $tipo_proceso->nombre)->orderBy('created_at', 'asc')->first();
        echo $proceso_contractual->objeto;
        echo "<br>";

        echo "<br> Tiempo promedio en llegar a Adquisiciones: ";
        echo "<br>";

        //Datos de las etapas del proceso
        $etapas=\App\Etapa::where('tipo_procesos_id', $tipo_proceso->id)->orderBy('indice', 'asc')->get();
        foreach ($etapas as $etapa) {
            echo "<br> Etapa: " . $etapa->nombre;
            $cantidadProcesosEnEtapa = DB::table('proceso_contractuals')
                        ->where('tipo_proceso', $tipo_proceso->nombre)
                        ->where('estado', $etapa->nombre)->count();
            echo "<br> Cantidad de procesos en esta etapa: ".$cantidadProcesosEnEtapa;
            echo "<br>";
        }
        echo "<br> ---------------------------------------------------<br>";
    }


    echo "<br>";
    echo "<br>";
    $proceso_contractual = \App\ProcesoContractual::find(4);
    $fechaCreacionProceso = $proceso_contractual->created_at;
    echo 'Fecha creación: '.$fechaCreacionProceso;
    echo "<br>";
    $fechaActualizacionProceso = $proceso_contractual->updated_at;
    echo 'Fecha actualización: '.$fechaActualizacionProceso;
    echo "<br>";
    echo "<br> Diferencia en horas: ".$fechaActualizacionProceso->diffInDays($fechaCreacionProceso);



});



Route::resource('archivos','ArchivoController');
Route::post('archivos/eliminar/{idproceso}/{idrequisito}', ['as'=>'archivos.eliminar','uses'=> 'ArchivoController@eliminar_documento']);


