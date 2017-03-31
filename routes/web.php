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
});





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

});


Route::get('test7', function (){


    $id_rol_administrador=1;
    $id_usuarios =DB::table('users')
        ->join('user_rol', function ($join) use ($id_rol_administrador)  {
            $join->on('users.id', '=', 'user_rol.user_id')
                ->where('user_rol.rol_id', '=', $id_rol_administrador);
        })
        ->select('users.id')
        ->get();
    foreach ($id_usuarios as $id_usuario){
        $usuario=App\User::find($id_usuario->id);
        $usuario->notify(new \App\Notifications\CambioEstado());
    }

});

Route::get('test8', function (){


    /**$users = DB::table('users')
        ->join('contacts', 'users.id', '=', 'contacts.user_id')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('users.*', 'contacts.phone', 'orders.price')
        ->get();
    **/
    $usuarios_id=DB::table('etapa_rol')
        ->where('etapa_id', 1)
        ->join('rols', function ($join)  {
            $join->on('etapa_rol.rol_id', '=', 'rols.id');
        })
        ->join('user_rol', function ($join)  {
            $join->on('rols.id', '=', 'user_rol.rol_id');
        })
        ->join('users', function ($join)  {
            $join->on('user_rol.user_id', '=', 'users.id');
        })
        ->select('users.id')
        ->distinct()
        ->get();

    $proceso = \App\ProcesoContractual::find(2);

    foreach ($usuarios_id as $usuario_id) {
            $usuario = App\User::find($usuario_id->id);
            $roles=DB::table('etapa_rol')
                ->where('etapa_id', 1)
                ->join('rols', function ($join)  {
                    $join->on('etapa_rol.rol_id', '=', 'rols.id');
                })
                ->join('user_rol', function ($join) use ($usuario)  {
                    $join->on('rols.id', '=', 'user_rol.rol_id')
                    ->where('user_rol.user_id', '=', $usuario->id);
                })
                ->select('rols.nombre')
                ->get();
            $usuario->notify(new \App\Notifications\CambioEtapa($proceso, 'juan carlos',"ESCRITOR"));
            echo $usuario->nombre . '  '. '<br>';
            foreach ($roles as $rol){
                echo $rol->nombre;
            }
            echo '<br>';

    }


});
