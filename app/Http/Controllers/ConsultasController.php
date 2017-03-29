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
        return view($this->path.'.consultaproceso', compact('procesos_contractuales', 'tipos_procesos'));
    }

    public function ver_mas($proceso_contractual_id)
    {
        $proceso_contractual = ProcesoContractual::findOrFail($proceso_contractual_id);
        $etapas=Etapa::where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id)->orderBy('indice', 'asc')->get();
        $requisitos=Requisito::all();
        return view($this->path.'.consultavermas', compact('proceso_contractual', 'etapas', 'requisitos'));
    }
}