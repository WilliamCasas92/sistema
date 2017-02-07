<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Ruta Inicio
Route::get('/', function () {
    return view('welcome');
});

//Ruta Home
Route::get('home', function () {
    return view('home');
});
//Rutas Usuarios
Route::resource('users', 'UserController');
//Rutas Google
Route::get('social/google', 'SocialController@getSocialAuth');
Route::get('social/callback/google', 'SocialController@getSocialAuthCallback');

//Rutas LogIn LogOut
Auth::routes();

Route::get('/home', 'HomeController@index');

//Rutas TipoProceso
Route::resource('tipoproceso', 'TipoProcesoController');

//Rutas Etapa
Route::get('etapa/{et1}', ['as'=>'etapa.almacenar','uses'=> 'EtapaController@almacenar']);

Route::resource('etapa', 'EtapaController');

//Rutas Requisitos
Route::get('requisito/{req1}', ['as'=>'requisito.almacenar','uses'=> 'RequisitoController@almacenar']);

Route::post('requisito/{requisito}', ['as'=>'requisito.guardar','uses'=> 'RequisitoController@guardar']);

Route::resource('requisito', 'RequisitoController');

//Rutas Procesos Contractuales
Route::resource('procesocontractual', 'ProcesoContractualController');

//Rutas Datos Etapas
Route::get('datosetapas/{datoetapa}', ['as'=>'datosetapas.menu','uses'=> 'DatosEtapaController@menu']);
Route::resource('datosetapas', 'DatosEtapaController');





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
        echo $req->etapas->nombre . " CONTIENE EL REQUISITO: " . $req->nombre." DEL TIPO: " . $req->tipo_requisitos->nombre . "<br/>";
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