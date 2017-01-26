<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;
use App\Etapa;
use App\Requisito;

class EtapaController extends Controller
{
    private $path = 'etapa';
    public function index()
    {
        //$data = Etapa::all();
        //return view($this->path.'.index', compact('data'));
    }


    public function almacenar($id)
    {
        $data=Etapa::where('tipo_procesos_id', $id)->get();
        $data1=Requisito::all();
        return view($this->path.'.almacenar', compact('data', 'id', 'data1'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        try{
            $etapa = new Etapa();
            $etapa->nombre       = $request->nombre;
            $etapa->tipo_procesos_id = $request->idtipoproceso;
            $etapa->save();

            $etapa->roles()->detach();
            if ($request['rol_admin']){
                $etapa->roles()->attach(1);
            }
            if ($request['rol_coordinador']){
                $etapa->roles()->attach(2);
            }
            if ($request['rol_secretario']){
                $etapa->roles()->attach(3);
            }
            if ($request['rol_abogado']) {
                $etapa->roles()->attach(4);
            }
            if ($request['rol_gestorcontratacion']) {
                $etapa->roles()->attach(5);
            }
            if ($request['rol_gestornotificacion']) {
                $etapa->roles()->attach(6);
            }
            if ($request['rol_gestorafiliacion']) {
                $etapa->roles()->attach(7);
            }
            if ($request['rol_gestorarchivo']) {
                $etapa->roles()->attach(8);
            }
            if ($request['rol_gestorpublicacion']) {
                $etapa->roles()->attach(9);
            }
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $etapa = Etapa::findOrFail($id);
        //return view($this->path.'.index', compact('etapa'));
       // $data=Etapa::where('tipo_procesos_id', $id)->get();
        //$data1=Requisito::all();
        return view($this->path.'.modalrol', compact('etapa'));
    }

    public function update(Request $request, $id)
    {
        try{
            $etapa = Etapa::findOrFail($id);
            $etapa->save();

            $etapa->roles()->detach();
            if ($request['rol_admin']){
                $etapa->roles()->attach(1);
            }
            if ($request['rol_coordinador']){
                $etapa->roles()->attach(2);
            }
            if ($request['rol_secretario']){
                $etapa->roles()->attach(3);
            }
            if ($request['rol_abogado']) {
                $etapa->roles()->attach(4);
            }
            if ($request['rol_gestorcontratacion']) {
                $etapa->roles()->attach(5);
            }
            if ($request['rol_gestornotificacion']) {
                $etapa->roles()->attach(6);
            }
            if ($request['rol_gestorafiliacion']) {
                $etapa->roles()->attach(7);
            }
            if ($request['rol_gestorarchivo']) {
                $etapa->roles()->attach(8);
            }
            if ($request['rol_gestorpublicacion']) {
                $etapa->roles()->attach(9);
            }
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function destroy($id)
    {
        try{
            $etapa = Etapa::findOrFail($id);
            $etapa->roles()->detach();
            $etapa->delete();
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
}
