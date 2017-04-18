<?php

namespace App\Http\Controllers;

use App\Observacion;
use App\User;
use Illuminate\Http\Request;

class ObservacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $observacion = new Observacion();
            $observacion->proceso_contractual_id = $request->proceso_contractual_id;
            $observacion->user_id = $request->user_id;
            $observacion->observacion= $request->observacion;
            $observacion->save();
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $observacion = Observacion::find($id);
            $observacion->proceso_contractual_id = $request->proceso_contractual_id;
            $observacion->user_id = $request->user_id;
            $observacion->observacion= $request->observacion;
            $observacion->save();
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $observacion = Observacion::find($id);;
            $observacion->delete();
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    static function busqueda_usuario($id)
    {
        $usuario = User::find($id);
        $nombre = $usuario->nombre." ".$usuario->apellidos;
        return $nombre;
    }
}
