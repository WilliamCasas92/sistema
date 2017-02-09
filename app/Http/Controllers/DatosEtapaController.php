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
        //$datos_etapas_proceso=DatoEtapa::where('proceso_contractual_id', $proceso_contractual->id)->get();
        return view($this->path.'.menu', compact('proceso_contractual', 'etapas', 'requisitos'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        try{
            $cont=0;
            foreach ($request['atributo'] as $atributo_) {
                if ($atributo_ != "") {
                    $dato_etapa_id = DB::table('dato_etapas')
                        ->where('proceso_contractual_id', $request->proceso_contractual_id)
                        ->where('requisitos_id', $request->requisito_id[$cont])
                        ->value('id');
                    if ($dato_etapa_id != null ){
                        //Edita Dato de la Etapa
                        $dato_etapa = DatoEtapa::findOrFail($dato_etapa_id);
                        $dato_etapa->valor = $atributo_;
                        $dato_etapa->save();
                        $cont++;
                    }else{
                        //Crea Dato de la Etapa
                        $dato_etapa = new DatoEtapa();
                        $dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                        $dato_etapa->valor = $atributo_;
                        $dato_etapa->requisitos_id = $request->requisito_id[$cont];
                        $dato_etapa->save();
                        $cont++;
                    }
                }
            }
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
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

    static function imprimir_tipo_requisitos($tipo_requisito_id)
    {
        $tipo_requisito=TipoRequisito::find($tipo_requisito_id);
        return $tipo_requisito->tipo;
    }

    static function busqueda_valor_dato_etapa($proceso_id, $req_id)
    {
        $valor = DB::table('dato_etapas')
            ->where('proceso_contractual_id', $proceso_id)
            ->where('requisitos_id', $req_id)
            ->value('valor');
        return $valor;
    }
}
