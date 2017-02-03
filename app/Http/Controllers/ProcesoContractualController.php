<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProcesoContractual;

class ProcesoContractualController extends Controller
{
    private $path = 'procesocontractual';
    public function index()
    {
        $procesos_contractuales= ProcesoContractual::all();
        return view($this->path.'.index', compact('procesos_contractuales'));
    }

    public function create()
    {
        return view($this->path.'.create');
    }

    public function store(Request $request)
    {
        try{
            $proceso_contractual = new ProcesoContractual();
            $proceso_contractual->tipo_proceso       = $request->tipo_proceso;
            $proceso_contractual->numero_cdp         = $request->num_cdp;
            $proceso_contractual->objeto             = $request->objeto;
            $proceso_contractual->dependencia        = $request->dependencia;
            if ($request['num_contrato']){
                $proceso_contractual->numero_contrato   = $request->num_contrato;
            } else {
                $proceso_contractual->numero_contrato   =null;
            }
            $proceso_contractual->fecha_aprobacion   = $request->date_aprobación;
            $proceso_contractual->nombre_supervisor  = $request->nombre_supervisor;
            $proceso_contractual->id_supervisor      = $request->id_supervisor;
            $proceso_contractual->email_supervisor   = $request->email_supervisor;
            $proceso_contractual->save();
            return redirect()->route('procesocontractual.index');
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
        $proceso_contractual = ProcesoContractual::findOrFail($id);
        return view($this->path.'.edit', compact('proceso_contractual'));
    }


    public function update(Request $request, $id)
    {
        $proceso_contractual = ProcesoContractual::findOrFail($id);
        $proceso_contractual->tipo_proceso       = $request->tipo_proceso;
        $proceso_contractual->numero_cdp         = $request->num_cdp;
        $proceso_contractual->objeto             = $request->objeto;
        $proceso_contractual->dependencia        = $request->dependencia;
        if ($request['num_contrato']){
            $proceso_contractual->numero_contrato   = $request->num_contrato;
        } else {
            $proceso_contractual->numero_contrato   =null;
        }
        $proceso_contractual->fecha_aprobacion   = $request->date_aprobación;
        $proceso_contractual->nombre_supervisor  = $request->nombre_supervisor;
        $proceso_contractual->id_supervisor      = $request->id_supervisor;
        $proceso_contractual->email_supervisor   = $request->email_supervisor;
        $proceso_contractual->save();
        return redirect()->route('procesocontractual.index');
    }

    public function destroy($id)
    {
        try{
            $proceso_contractual = ProcesoContractual::findOrFail($id);
            $proceso_contractual->delete();
            return redirect()->route('procesocontractual.index');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
}
