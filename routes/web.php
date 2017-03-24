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
        $cantidad_procesos = DB::table('proceso_contractuals')->where('tipo_proceso', $tipo_proceso->nombre)->count();
        echo "<br> Cantidad de procesos almacenados: ".$cantidad_procesos;
        echo "<br>";
        //Cantidad de procesos sin enviar a Adquisiciones
        $cantidad_procesos_sin_enviar = DB::table('proceso_contractuals')
                        ->where('tipo_proceso', $tipo_proceso->nombre)
                        ->Where('estado','Sin enviar al Área de Adquisiciones.')
                        ->count();

        echo "<br> Cantidad de procesos sin enviar a Adquisiciones: ".$cantidad_procesos_sin_enviar;
        echo "<br>";
        //Cantidad de procesos esperando ser recibidos en Adquisiciones
        $cantidad_procesos_enviados = DB::table('proceso_contractuals')
                        ->where('tipo_proceso', $tipo_proceso->nombre)
                        ->Where('estado','Enviado al Área de Adquisiciones.')
                        ->count();
        echo "<br> Cantidad de procesos esperando ser recibidos en Adquisiciones: ".$cantidad_procesos_enviados;

        //Tiempo promedio en llegar a Adquisiciones
        $contador_procesos_enviados_adquisiciones = 0;
        $tiempo_promedio_envio = 0;
        $procesos_contractuales=\App\ProcesoContractual::where('tipo_proceso',$tipo_proceso->nombre)->get();
        //Nombre de la primera etapa del tipo de proceso.
        $primera_etapa= DB::table('etapas')
            ->where('tipo_procesos_id', $tipo_proceso->id)
            ->where('indice', 1)
            ->value('nombre');
        $id_primera_etapa= DB::table('etapas')
            ->where('tipo_procesos_id', $tipo_proceso->id)
            ->where('indice', 1)
            ->value('id');
        foreach ($procesos_contractuales as $proceso_contractual){
            //Fecha de Envío a Adqui.
            $historico_proceso_etapa = \App\HistoricoProcesoEtapa::
                        where('proceso_contractual_id', $proceso_contractual->id)
                        ->where('etapas_id', $id_primera_etapa)
                        ->where('estado', $primera_etapa)
                        ->first();
            if (!$historico_proceso_etapa){
                break;
            }
            $fecha_envio_proceso = $historico_proceso_etapa->created_at;
            echo "<br>";
            echo "ID de proceso: ".$proceso_contractual->id;
            //Fecha de Creacion en el sistema.
            $fecha_creacion_proceso = $proceso_contractual->created_at;
            echo "<br>";
            echo "Fecha de creación: ".$fecha_creacion_proceso;
            echo "<br>";
            echo "Fecha de envío: ".$fecha_envio_proceso;
            echo "<br>";
            $intervalo_diferencia_fecha = $fecha_envio_proceso->diffInSeconds($fecha_creacion_proceso);
            //Acumula los tiempos de intervalos
            $tiempo_promedio_envio = $tiempo_promedio_envio + $intervalo_diferencia_fecha;
            echo "<br> Diferencia en segundos: ".$intervalo_diferencia_fecha;
            $contador_procesos_enviados_adquisiciones ++;
        }
        if ($contador_procesos_enviados_adquisiciones!=0){
            echo "<br> Tiempo promedio en llegar a Adquisiciones: ".(($tiempo_promedio_envio)/($contador_procesos_enviados_adquisiciones));
        }


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
    $proceso_contractual = \App\ProcesoContractual::find(1);
    $fechaCreacionProceso = $proceso_contractual->created_at;
    echo 'Fecha creación: '.$fechaCreacionProceso;
    echo "<br>";
    $fechaActualizacionProceso = $proceso_contractual->updated_at;
    echo 'Fecha actualización: '.$fechaActualizacionProceso;
    echo "<br>";
    echo "<br> Diferencia en horas: ".$fechaActualizacionProceso->diffInHours($fechaCreacionProceso);



});

