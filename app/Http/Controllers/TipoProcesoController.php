<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;

class TipoProcesoController extends Controller
{
    private $path = 'tipoproceso';
    public function index()
    {
        $data = TipoProceso::all();
        return view($this->path.'.index', compact('data'));
    }

    public function create()
    {
        return view($this->path.'.create');
    }

    public function store(Request $request)
    {
        try{
            $tipoproceso = new TipoProceso();
            $tipoproceso->nombre       = $request->nombre;
            if(TipoProceso::select()->where('nombre','=', $tipoproceso->nombre)->first()) {
                return back()->with('msj', 'El nombre que intenta ingresar ya existe en el sistema.');
            }
            if ($request['activo']){
                $tipoproceso->activo       = $request->activo;
            } else {
                $tipoproceso->activo       ='0';
            }
            $tipoproceso->save();
            return redirect()->route('tipoproceso.index');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tipoproceso = TipoProceso::findOrFail($id);
        return view($this->path.'.edit', compact('tipoproceso'));
    }

    public function update(Request $request, $id)
    {
        $tipoproceso = TipoProceso::findOrFail($id);
        $tipoproceso->nombre       = $request->nombre;
        if ($request['activo']){
            $tipoproceso->activo       = $request->activo;
        } else {
            $tipoproceso->activo       ='0';
        }
        $tipoproceso->save();
        return redirect()->route('tipoproceso.index');
    }

    public function destroy($id)
    {
        try{
            $tipoproceso = TipoProceso::findOrFail($id);
            $tipoproceso->delete();
            return redirect()->route('tipoproceso.index');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
}