<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProcesoContractual;
use App\Etapa;
use App\Requisito;

class ConsultasController extends Controller
{
    private $path = 'consulta';

    public function mostrar()
    {
        $procesos_contractuales= ProcesoContractual::all();
        return view($this->path.'.consultaproceso', compact('procesos_contractuales'));
    }

    public function ver_mas($proceso_contractual_id)
    {
        $proceso_contractual = ProcesoContractual::findOrFail($proceso_contractual_id);
        $etapas=Etapa::where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id)->orderBy('indice', 'asc')->get();
        $requisitos=Requisito::all();
        return view($this->path.'.consultavermas', compact('proceso_contractual', 'etapas', 'requisitos'));
    }
}
