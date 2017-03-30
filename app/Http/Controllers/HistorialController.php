<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ProcesoContractual;
use App\HistoricoDatoEtapa;
use App\HistoricoProcesoEtapa;
use App\User;
use App\Requisito;

class HistorialController extends Controller
{
    private $path = 'historiales';

    public function mostrar($proceso_id)
    {
        $proceso_contractual = ProcesoContractual::find($proceso_id);
        $historicos_proceso_etapas = HistoricoProcesoEtapa::where('proceso_contractual_id', $proceso_id)->orderBy('id', 'dsc')->get();
        $historicos_datos_etapas = HistoricoDatoEtapa::where('proceso_contractual_id', $proceso_id)->orderBy('id', 'dsc')->get();
        return view($this->path.'.index', compact('historicos_datos_etapas', 'historicos_proceso_etapas', 'proceso_contractual'));
    }

    static function buscar_usuario($id_usuario){
        //Busca el usuario.
        return $usuario = User::find($id_usuario);
    }

    static function buscar_requisito($id_requisito){
        //Busca el requisito.
        return $requisito = Requisito::find($id_requisito);
    }

    static function buscar_dato_anterior($id_requisito, $id_proceso, $id_dato_actual){
        //Busca el dato anterior.
        $dato_anterior = DB::table('historico_dato_etapas')
            ->whereNotIn('id', [$id_dato_actual])
            ->where('requisitos_id', $id_requisito)
            ->where('proceso_contractual_id', $id_proceso)
            ->first();

        if (!$dato_anterior){
            return false;
        }else{
            return $dato_anterior;
        }
    }
}
