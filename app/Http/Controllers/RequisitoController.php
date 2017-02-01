<?php

namespace App\Http\Controllers;

use App\Etapa;
use App\Requisito;
use Illuminate\Http\Request;

class RequisitoController extends Controller
{
    private $path = 'etapa';
    public function index()
    {
        //$data1=Requisito::all();
        //return view($this->path.'.index', compact('data1'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $requsito = Requisito::findOrFail($id);
        return view($this->path.'.editrequisito', compact('requsito'));
    }

    public function update(Request $request, $id)
    {
        $requsito = Requisito::findOrFail($id);
        $requsito->nombre       = $request->nombre;
        $requsito->tipo_requisitos_id =$request->tiporequisito;
        if ($request['obligatorio']){
            $requsito->obligatorio       = $request->obligatorio;
        } else {
            $requsito->obligatorio       ='0';
        }
        $requsito->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        try{
            $requsito = Requisito::findOrFail($id);
            $requsito->delete();
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function almacenar($id)
    {
    }

    public function guardar(Request $request, $id)
    {
        try{
            $requsito = new Requisito();
            $requsito->nombre       = $request->nombre;
            $requsito->etapas_id    =$id;
            $requsito->tipo_requisitos_id =$request->tiporequisito;
            if ($request['obligatorio']){
                $requsito->obligatorio       = $request->obligatorio;
            } else {
                $requsito->obligatorio       ='0';
            }
            $requsito->save();
            $data1=Requisito::all();
            $etapa=Etapa::findOrFail($id);
            //return redirect()->back();
            return view($this->path.'.indexrequisitos', compact('data1','etapa'));
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
}
