<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ProcesoContractual;
use App\HistoricoDatoEtapa;
use App\HistoricoProcesoEtapa;
use App\User;

class HistorialController extends Controller
{
    private $path = 'historiales';

    public function mostrar($proceso_id)
    {
        $proceso_contractual = ProcesoContractual::find($proceso_id);
        $historicos_proceso_etapas = HistoricoProcesoEtapa::where('proceso_contractual_id', $proceso_id)->get();
        $historicos_datos_etapas = HistoricoDatoEtapa::where('proceso_contractual_id', $proceso_id)->get();
        return view($this->path.'.index', compact('historicos_datos_etapas', 'historicos_proceso_etapas', 'proceso_contractual'));
    }

    static function buscar_usuario($id_usuario){
        //Busca el usuario.
        return $usuario = User::find($id_usuario);
    }
}
