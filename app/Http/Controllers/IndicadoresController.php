<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;
use App\ProcesoContractual;
use App\Etapa;

class IndicadoresController extends Controller
{
    private $path='indicadores';

    public function index()
    {
        $tipos_procesos = TipoProceso::all();
        $procesos_contractuales = ProcesoContractual::all();
        $etapas = Etapa::all();
        return view($this->path.'.index', compact('tipos_procesos', 'procesos_contractuales', 'etapas'));
    }

    public function create()
    {

    }

}
