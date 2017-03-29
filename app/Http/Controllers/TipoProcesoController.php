<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;
use App\ProcesoContractual;
use Exception;
use Illuminate\Support\Facades\DB;

class TipoProcesoController extends Controller
{
    private $path = 'tipoproceso';
    public function index()
    {
        $tipos_procesos = TipoProceso::all();
        return view($this->path.'.index', compact('tipos_procesos'));
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
            $tipoproceso->version       = $request->version;
            if(TipoProceso::select()
                        ->where('nombre','=', $tipoproceso->nombre)
                        ->where('version', '=', $tipoproceso->version)->first()) {
                return back()->with('error', 'El Tipo de proceso:'.$tipoproceso->nombre .', con versión:'.$tipoproceso->version.', ya esta registrado en el sistema.');
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
        $tipoproceso->version       = $request->version;
        if($tipoprocesoAux=TipoProceso::select()
                ->where('nombre','=', $tipoproceso->nombre)
                ->where('version', '=', $tipoproceso->version)->first()){
            if ($tipoproceso->id <> $tipoprocesoAux->id) {
                //Alert::message('Este tipo de proceso ya existe en el sistema', 'danger');
                return back()->with('error', 'El Tipo de proceso:'.$tipoproceso->nombre .', con versión:'.$tipoproceso->version.', ya esta registrado en el sistema.');
            }
        }
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
            $procesocontractual = DB::table('proceso_contractuals')->where('tipo_procesos_id', $id)->count();
            if($procesocontractual){
                return redirect()->route('tipoproceso.index')->with('error','El Tipo de proceso: '.$tipoproceso->nombre.', versión '.$tipoproceso->version.' no se puede eliminar porque tiene etapas asociadas.');
            }
            $tipoproceso_nombre= $tipoproceso->nombre;
            $tipoproceso_version= $tipoproceso->version;
            $tipoproceso->delete();
            return redirect()->route('tipoproceso.index')->with('status', 'El Tipo de proceso: '.$tipoproceso_nombre.', versión '.$tipoproceso_version.' ha sido eliminado con éxito.');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
}