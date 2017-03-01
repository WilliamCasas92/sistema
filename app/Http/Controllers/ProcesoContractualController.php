<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\ProcesoContractual;
use App\TipoProceso;
use App\ProcesoEtapa;
use App\HistoricoProcesoEtapa;

class ProcesoContractualController extends Controller
{
    private $path = 'procesocontractual';
    public function index()
    {
        $num_cdp = \Request::get('NumCDP');
        $num_contrato = \Request::get('NumContrato');
        $tipo_proceso = \Request::get('TipoProceso');
        $dependencia = \Request::get('dependencia');
        $objeto = \Request::get('Objeto');

        $procesos_contractuales= ProcesoContractual::
        Where('numero_cdp', 'like', '%'.$num_cdp.'%')
            ->Where('numero_contrato', 'like', '%'.$num_contrato.'%')
            ->Where('tipo_proceso', 'like', '%'.$tipo_proceso.'%')
            ->Where('dependencia', 'like', $dependencia.'%')
            ->Where('objeto', 'like', '%'.$objeto.'%')
            ->orderBy('year_cdp', 'desc')
            ->orderBy('numero_cdp', 'desc')->paginate(10);

        $tipos_procesos= TipoProceso::all();
        return view($this->path.'.index', compact('procesos_contractuales', 'tipos_procesos'));
    }

    public function create()
    {
        $tipos_procesos= TipoProceso::where('activo',1)->get();
        return view($this->path.'.create', compact('tipos_procesos'));
    }

    public function store(Request $request)
    {
        try{
            $proceso_contractual = new ProcesoContractual();
            $proceso_contractual->tipo_proceso       = $request->tipo_proceso;
            $proceso_contractual->numero_cdp         = $request->num_cdp;
            $proceso_contractual->year_cdp           = date("Y");
            $proceso_contractual->objeto             = $request->objeto;
            $proceso_contractual->valor             = $request->num_valor;
            $proceso_contractual->plazo             = $request->num_plazo;
            $proceso_contractual->dependencia        = $request->dependencia;
            if ($request['num_contrato']){
                $proceso_contractual->numero_contrato   = $request->num_contrato;
            }else{
                $proceso_contractual->numero_contrato   = '0';
            }
            $proceso_contractual->nombre_supervisor  = $request->nombre_supervisor;
            $proceso_contractual->id_supervisor      = $request->id_supervisor;
            $proceso_contractual->email_supervisor   = $request->email_supervisor;
            $proceso_contractual->user_id            = \Auth::user()->id;
            $proceso_contractual->tipo_procesos_id   = DB::table('tipo_procesos')->where('nombre', $request->tipo_proceso)->value('id');
            $proceso_contractual->estado             = 'Sin enviar al Área de Adquisiciones.';

            if(ProcesoContractual::select()
                ->where('numero_cdp','=', $proceso_contractual->numero_cdp)
                ->where('year_cdp', '=', $proceso_contractual->year_cdp )->first()) {
                return back()->with('error', 'El Proceso Contractual con CDP:'.$proceso_contractual->numero_cdp .' ya esta registrado en el sistema.');
            }else if(ProcesoContractual::select()
                ->where('numero_contrato','=', $proceso_contractual->num_contrato)->first()) {
                return back()->with('error', 'El Numero de contrato:'.$proceso_contractual->numero_contrato .' ya esta registrado en otro proceso.');
            }

            if ($request['comite_docenciainv']){
                $proceso_contractual->comiteinterno         = $request->comite_docenciainv;
                $proceso_contractual->fecha_comiteinterno   = $request->date_aprobación1;
            }elseif($request['comite_extension']){
                $proceso_contractual->comiteinterno         = $request->comite_extension;
                $proceso_contractual->fecha_comiteinterno   = $request->date_aprobación1;
                }elseif ($request['comite_admin']){
                    $proceso_contractual->comiteinterno         = $request->comite_admin;
                    $proceso_contractual->fecha_comiteinterno   = $request->date_aprobación1;
                }else{
                $proceso_contractual->comiteinterno         ='0';
                $proceso_contractual->fecha_comiteinterno   = '';
            }

            if ($request['comite_rectoria']){
                $proceso_contractual->comiterectoria        = $request->comite_rectoria;
                $proceso_contractual->fecha_comiterectoria   = $request->date_aprobación2;
            } else {
                $proceso_contractual->comiterectoria        ='0';
                $proceso_contractual->fecha_comiterectoria   = '';
            }

            if ($request['comite_asesor']){
                $proceso_contractual->comiteasesor          = $request->comite_asesor;
                $proceso_contractual->fecha_comiteasesor   = $request->date_aprobación3;
            } else {
                $proceso_contractual->comiteasesor          ='0';
                $proceso_contractual->fecha_comiteasesor   = '';
            }

            if ($request['comite_ev']){
                $proceso_contractual->comiteevaluador       = $request->comite_ev;
                $proceso_contractual->fecha_comiteevaluador   = $request->date_aprobación4;
            } else {
                $proceso_contractual->comiteevaluador       ='0';
                $proceso_contractual->fecha_comiteevaluador   = '';
            }

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
        $tipos_procesos= TipoProceso::where('activo',1)->get();
        return view($this->path.'.edit', compact('proceso_contractual', 'tipos_procesos'));
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
        }else{
            $proceso_contractual->numero_contrato   = '0';
        }
        $proceso_contractual->fecha_aprobacion   = $request->date_aprobación;
        $proceso_contractual->nombre_supervisor  = $request->nombre_supervisor;
        $proceso_contractual->id_supervisor      = $request->id_supervisor;
        $proceso_contractual->email_supervisor   = $request->email_supervisor;

        if($proceso_contractualAux=ProcesoContractual::select()
            ->where('numero_cdp','=', $proceso_contractual->numero_cdp)
            ->where('year_cdp', '=', $proceso_contractual->year_cdp )->first()) {
            if ($proceso_contractual->id <> $proceso_contractualAux->id) {
                return back()->with('error', 'El Proceso Contractual con CDP:'.$proceso_contractual->numero_cdp .' ya esta registrado en el sistema.');
            }
        }
        if($proceso_contractualAux2=ProcesoContractual::select()
                    ->where('numero_contrato','=', $proceso_contractual->numero_contrato)->first()) {
            if ($proceso_contractual->id <> $proceso_contractualAux2->id) {
                return back()->with('error', 'El Numero de contrato:'.$proceso_contractual->numero_contrato .' ya esta registrado en otro proceso.');
            }
        }
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

    public function enviar($idproceso)
    {
        try{
            $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
            //Creando tabla proceso_etapa
            $proceso_etapa = new ProcesoEtapa();
            $proceso_etapa->proceso_contractual_id   = $idproceso;
            $proceso_etapa->etapas_id                = DB::table('etapas')
                ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                ->where('indice', 1)
                ->value('id');
            $proceso_etapa->user_id                  = \Auth::user()->id;;
            $proceso_etapa->estado                   = 'Activo';
            $proceso_etapa->save();
            $proceso_contractual->estado             = 'Enviado al Área de Adquisiciones.';
            //Guardando en el historial
            $historial_proceso_etapa = new HistoricoProcesoEtapa();
            $historial_proceso_etapa->proceso_etapa_id  = $proceso_etapa->id;
            $historial_proceso_etapa->proceso_contractual_id = $idproceso;
            $historial_proceso_etapa->etapas_id         = $proceso_etapa->etapas_id;
            $historial_proceso_etapa->user_id           = \Auth::user()->id;
            $historial_proceso_etapa->estado            = $proceso_contractual->estado;
            $historial_proceso_etapa->save();
            $proceso_contractual->save();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
        return back();
    }

    public function recibir($idproceso)
    {
        try{
            $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
            //Creando tabla proceso_etapa
            $id_etapa   =DB::table('etapas')
                            ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                            ->where('indice', 1)
                            ->value('id');
            $proceso_etapa=ProcesoEtapa::
                            where('proceso_contractual_id', $idproceso)
                            ->where('etapas_id', $id_etapa)
                            ->first();
            $proceso_etapa->user_id                  = \Auth::user()->id;
            $proceso_etapa->save();

            $proceso_contractual->estado             = DB::table('etapas')
                ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                ->where('indice', 1)
                ->value('nombre');

            //Guardando en el historial
            $historial_proceso_etapa = new HistoricoProcesoEtapa();
            $historial_proceso_etapa->proceso_etapa_id  = $proceso_etapa->id;
            $historial_proceso_etapa->proceso_contractual_id = $idproceso;
            $historial_proceso_etapa->etapas_id         = $proceso_etapa->etapas_id;
            $historial_proceso_etapa->user_id           = \Auth::user()->id;
            $historial_proceso_etapa->estado            = $proceso_contractual->estado;
            $historial_proceso_etapa->save();
            $proceso_contractual->save();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
        return back();
    }

}