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
use App\HistoricoDatoEtapa;
use App\ProcesoEtapa;

class DatosEtapaController extends Controller
{
    private $path = 'datosetapas';

    public function index()
    {
    }

    public function menu($proceso_contractual_id)
    {
        $proceso_contractual=DB::table('proceso_contractuals')->where('id', $proceso_contractual_id)->first();
        $etapas=Etapa::where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id)->orderBy('indice', 'asc')->get();
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
                $dato_etapa_id = DB::table('dato_etapas')
                    ->where('proceso_contractual_id', $request->proceso_contractual_id)
                    ->where('requisitos_id', $request->requisito_id[$cont])
                    ->value('id');
                if ($dato_etapa_id != null ){
                    //Edita Dato de la Etapa
                    $dato_etapa = DatoEtapa::findOrFail($dato_etapa_id);
                    $dato_etapa->valor = $atributo_;
                    $dato_etapa->user_id = $request->user_id;
                    $dato_etapa->save();
                    //Guardando en el historial
                    $historial_dato_etapa = new HistoricoDatoEtapa();
                    $historial_dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                    $historial_dato_etapa->valor = $atributo_;
                    $historial_dato_etapa->user_id = $request->user_id;
                    $historial_dato_etapa->requisitos_id = $request->requisito_id[$cont];
                    $historial_dato_etapa->save();
                    $cont++;
                }else{
                    //Crea Dato de la Etapa
                    $dato_etapa = new DatoEtapa();
                    $dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                    $dato_etapa->user_id = $request->user_id;
                    $dato_etapa->valor = $atributo_;
                    $dato_etapa->requisitos_id = $request->requisito_id[$cont];
                    $dato_etapa->save();
                    //Guardando en el historial
                    $historial_dato_etapa = new HistoricoDatoEtapa();
                    $historial_dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                    $historial_dato_etapa->valor = $atributo_;
                    $historial_dato_etapa->user_id = $request->user_id;
                    $historial_dato_etapa->requisitos_id = $request->requisito_id[$cont];
                    $historial_dato_etapa->save();
                    $cont++;
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

    static function busqueda_etapa_activa($proceso_id, $etapa_id)
    {
       $activo= DB::table('proceso_etapas')
           ->where('proceso_contractual_id', $proceso_id)
           ->where('etapas_id', $etapa_id )
           ->value('estado');
       return $activo;
    }

    public function enviar_etapa($idproceso, $idetapa, $iduser)
    {
        try{
            $etapa=Etapa::findOrFail($idetapa);
            $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
            $contenido_validacion=$this->validar_datos_obligatorios($etapa->id);
            if($contenido_validacion->resultado==true){
                //Actualizando tabla proceso_etapa
                $proceso_etapa=ProcesoEtapa::
                where('proceso_contractual_id', $idproceso)
                    ->where('etapas_id', $idetapa)
                    ->first();
                $proceso_etapa->etapas_id                = DB::table('etapas')
                    ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                    ->where('indice', $etapa->indice + 1)
                    ->value('id');
                $proceso_etapa->user_id                  = $iduser;
                $proceso_contractual->estado             = $etapa->nombre;
                $proceso_contractual->save();
                $proceso_etapa->save();
                return view('datosetapas/pasoetapa');
            }
            return $contenido_validacion->mensaje;
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function validar_datos_obligatorios($id_etapa)
    {
        $contenido_validacion = new \stdClass();
        $datos = DB::table('dato_etapas')
            ->join('requisitos', function ($join) use ($id_etapa) {
                $join->on('dato_etapas.requisitos_id', '=', 'requisitos.id')
                    ->where('requisitos.etapas_id', '=', $id_etapa);
            })
            ->get();
        if ($datos->count()){
            foreach ($datos as $dato){
                if (($dato->obligatorio=='1') &&
                    ( ($dato->valor=='')||($dato->valor=='0') )){
                        $contenido_validacion->mensaje      = 'Debe diligenciar el campo "'.$dato->nombre.'" para finalizar la etapa.';
                        $contenido_validacion->resultado    = false;
                        return $contenido_validacion;
                }
            }
        }else{
            $contenido_validacion->mensaje      = 'No se ha guardado ningun dato.';
            $contenido_validacion->resultado    = false;
            return $contenido_validacion;
        }
        $contenido_validacion->mensaje      = '';
        $contenido_validacion->resultado    = true;
        return $contenido_validacion;
    }
}
