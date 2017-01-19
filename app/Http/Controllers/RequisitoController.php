<?php

namespace App\Http\Controllers;

use App\Requisito;
use Illuminate\Http\Request;

class RequisitoController extends Controller
{
    private $path = 'requisito';
    public function index()
    {
        $data1=Requisito::all();
        return view($this->path.'.index', compact('data1'));
    }

    //NO
    public function create()
    {
        //
    }
    //NO
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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
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
            if(Requisito::select()->where('nombre','=', $requsito->nombre)->first()) {
                return back()->with('msj', 'El nombre que intenta ingresar ya existe en el sistema.');
            }
            if ($request['obligatorio']){
                $requsito->obligatorio       = $request->obligatorio;
            } else {
                $requsito->obligatorio       ='0';
            }
            $requsito->save();
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
}
