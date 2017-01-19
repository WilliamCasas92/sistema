<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;
use App\Etapa;

class EtapaController extends Controller
{
    private $path = 'etapa';
    public function index()
    {
        //$data = Etapa::all();
        //return view($this->path.'.index', compact('data'));
    }

    public function create()
    {
        //return view($this->path.'.create', compact('id'));
        //$data=Etapa::all();
        //return view($this->path.'.create', compact('data'));
    }

    //este metodo aun no funciona como debe ser...
    public function store(Request $request)
    {
        try{
            $etapa = new Etapa();
            $etapa->nombre       = $request->nombre;
            $etapa->tipo_procesos_id = '2';
            if(Etapa::select()->where('nombre','=', $etapa->nombre)->first()) {
                return back()->with('msj', 'El nombre que intenta ingresar ya existe en el sistema.');
            }
            $etapa->save();
            return redirect()->route('etapa.create');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $data=Etapa::where('tipo_procesos_id', $id)->get();
        return view($this->path.'.edit', compact('data', 'id'));
    }

    public function update(Request $request, $id)
    {
        try{
            $etapa = new Etapa();
            $etapa->nombre       = $request->nombre;
            $etapa->tipo_procesos_id = $id;
            if(Etapa::select()->where('nombre','=', $etapa->nombre)->first()) {
                return back()->with('msj', 'El nombre que intenta ingresar ya existe en el sistema.');
            }
            $etapa->save();
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function destroy($id)
    {
        try{
            $etapa = Etapa::findOrFail($id);
            $etapa->delete();
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
}
