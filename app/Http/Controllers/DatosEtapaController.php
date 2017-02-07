<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\ProcesoContractual;
use Illuminate\Http\Request;
use App\TipoProceso;
use App\Etapa;
use App\Requisito;
use App\TipoRequisito;
use App\DatoEtapa;

class DatosEtapaController extends Controller
{
    private $path = 'datosetapas';

    public function index()
    {
    }

    public function menu($proceso_contractual_id)
    {
        $proceso_contractual=DB::table('proceso_contractuals')->where('id', $proceso_contractual_id)->first();
        $etapas=Etapa::where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id)->get();
        $requisitos=Requisito::all();
        return view($this->path.'.menu', compact('proceso_contractual', 'etapas', 'requisitos'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public static function imprimir_tipo_requisitos($tipo_requisito_id)
    {
        $tipo_requisito=TipoRequisito::find($tipo_requisito_id);
        echo $tipo_requisito->tipo;
    }
}
