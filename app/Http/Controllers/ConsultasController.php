<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ProcesoContractual;
use App\Etapa;
use App\Requisito;
use App\TipoProceso;


class ConsultasController extends Controller
{
    private $path = 'consulta';

    public function mostrar()
    {
        $id_rol_admin =1;
        $id_rol_coordinador=2;
        $id_rol_secretario = 3;
        $id_rol_secretario_tecnico = 10;
        $user_id = \Auth::user()->id;
        $procesos_contractuales = DB::table('proceso_contractuals');

        $admin = DB::table('user_rol')
            ->where('rol_id', '=', $id_rol_secretario)
            ->where('user_id', '=', $user_id)
            ->get();


        $secretario = DB::table('user_rol')
            ->where('rol_id', '=', $id_rol_secretario)
            ->where('user_id', '=', $user_id)
            ->get();

        $secretario_tecnico = DB::table('user_rol')
            ->where('rol_id', '=', $id_rol_secretario_tecnico)
            ->where('user_id', '=', $user_id)
            ->get();

        if (count($secretario) == 0 && count( $secretario_tecnico)== 0){
            $procesos_contractuales = DB::table('user_rol')
                ->join('rols', function ($join) use ($user_id) {
                    $join->on('user_rol.rol_id', '=', 'rols.id')
                        ->where('user_rol.user_id', '=', $user_id);
                })
                ->join('etapa_rol', 'rols.id', '=', 'etapa_rol.rol_id')
                ->join('proceso_etapas', 'etapa_rol.etapa_id', '=', 'proceso_etapas.etapas_id')
                ->join('proceso_contractuals', 'proceso_etapas.proceso_contractual_id', '=', 'proceso_contractuals.id')
                ->select('proceso_contractuals.*')
                ->union($procesos_contractuales)
                ->simplePaginate();

        }elseif (count($secretario) != 0  && count( $secretario_tecnico)== 0){
            $procesos_contractuales2 = DB::table('user_rol')
                ->join('rols', function ($join) use ($user_id) {
                    $join->on('user_rol.rol_id', '=', 'rols.id')
                        ->where('user_rol.user_id', '=', $user_id);
                })
            ->join('etapa_rol', 'rols.id', '=', 'etapa_rol.rol_id')
            ->join('proceso_etapas', 'etapa_rol.etapa_id', '=', 'proceso_etapas.etapas_id')
            ->join('proceso_contractuals', 'proceso_etapas.proceso_contractual_id', '=', 'proceso_contractuals.id')
            ->select('proceso_contractuals.*');


            $procesos_contractuales=DB::table('proceso_contractuals')
                ->where('estado', '=', 'Enviado al Área de Adquisiciones.')
                ->union($procesos_contractuales2)
                ->union($procesos_contractuales)
                ->simplePaginate();

        }elseif (count($secretario) == 0 && count( $secretario_tecnico)!= 0){
            $procesos_contractuales2 = DB::table('user_rol')
                ->join('rols', function ($join) use ($user_id) {
                    $join->on('user_rol.rol_id', '=', 'rols.id')
                        ->where('user_rol.user_id', '=', $user_id);
                })
                ->join('etapa_rol', 'rols.id', '=', 'etapa_rol.rol_id')
                ->join('proceso_etapas', 'etapa_rol.etapa_id', '=', 'proceso_etapas.etapas_id')
                ->join('proceso_contractuals', 'proceso_etapas.proceso_contractual_id', '=', 'proceso_contractuals.id')
                ->select('proceso_contractuals.*');

            $procesos_contractuales=DB::table('proceso_contractuals')
                ->where('estado', '=', 'Sin enviar al Área de Adquisiciones.')
                ->union($procesos_contractuales2)
                ->union($procesos_contractuales)
                ->simplePaginate();

        }elseif (count($secretario) != 0 && count( $secretario_tecnico)!= 0){
            $procesos_contractuales2 = DB::table('user_rol')
                ->join('rols', function ($join) use ($user_id) {
                    $join->on('user_rol.rol_id', '=', 'rols.id')
                        ->where('user_rol.user_id', '=', $user_id);
                })
                ->join('etapa_rol', 'rols.id', '=', 'etapa_rol.rol_id')
                ->join('proceso_etapas', 'etapa_rol.etapa_id', '=', 'proceso_etapas.etapas_id')
                ->join('proceso_contractuals', 'proceso_etapas.proceso_contractual_id', '=', 'proceso_contractuals.id')
                ->select('proceso_contractuals.*');

            $procesos_contractuales=DB::table('proceso_contractuals')
                ->where('estado', '=', 'Enviado al Área de Adquisiciones.')
                ->orwhere('estado', '=', 'Sin enviar al Área de Adquisiciones.')
                ->union($procesos_contractuales2)
                ->union($procesos_contractuales)
                ->simplePaginate();
        }

        $tipos_procesos= TipoProceso::where('activo',1)->get();
        return view($this->path.'.consultaproceso', compact('procesos_contractuales', 'tipos_procesos'));
    }

    public function consultar(Request $request)
    {
        $num_cdp = $request->NumCDP;
        $num_contrato = $request-> NumContrato;
        $year_cdp =$request->AnoCDP;
        $tipo_proceso = $request->TipoProceso;
        $dependencia = $request->dependencia;
        $objeto = $request->Objeto;

        $procesos_contractuales= ProcesoContractual::
        Where('numero_cdp', 'like', '%'.$num_cdp.'%')
            ->Where('numero_contrato', 'like', '%'.$num_contrato.'%')
            ->Where('tipo_proceso', 'like', '%'.$tipo_proceso.'%')
            ->Where('dependencia', 'like', $dependencia.'%')
            ->Where('objeto', 'like', '%'.$objeto.'%')
            ->Where('year_cdp', 'like', '%'.$year_cdp.'%')
            ->orderBy('year_cdp', 'desc')
            ->orderBy('numero_cdp', 'desc')->paginate(20);

        $mostrar_todos=1;
        $tipos_procesos= TipoProceso::where('activo',1)->get();
        return view($this->path.'.consultaproceso', compact('procesos_contractuales', 'tipos_procesos', 'mostrar_todos'));
    }

    public function ver_mas($proceso_contractual_id)
    {
        $proceso_contractual = ProcesoContractual::findOrFail($proceso_contractual_id);
        $etapas=Etapa::where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id)->orderBy('indice', 'asc')->get();
        $requisitos=Requisito::all();
        return view($this->path.'.consultavermas', compact('proceso_contractual', 'etapas', 'requisitos'));
    }
}