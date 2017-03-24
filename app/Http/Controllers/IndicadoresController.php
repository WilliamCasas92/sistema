<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;
use App\ProcesoContractual;
use App\Etapa;
use App\HistoricoProcesoEtapa;
use Illuminate\Support\Facades\DB;

class IndicadoresController extends Controller
{
    private $path='indicadores';

    public function index()
    {
        $tipos_procesos=TipoProceso::where('activo',1)->get();
        return view($this->path.'.index', compact('tipos_procesos'));
    }

    static function cantidad_procesos($nombreProceso){
        //Calcula la cantidad de procesos asociada al nombre del tipo de proceso de contratación.
        return $cantidad_procesos = DB::table('proceso_contractuals')->where('tipo_proceso', $nombreProceso)->count();
    }

    static function cantidad_procesos_sin_enviar($nombreProceso){
        //Cantidad de procesos sin enviar a Adquisiciones
        return $cantidad_procesos_sin_enviar = DB::table('proceso_contractuals')
                    ->where('tipo_proceso', $nombreProceso)
                    ->Where('estado','Sin enviar al Área de Adquisiciones.')
                    ->count();
    }

    static function cantidad_procesos_enviados($nombreProceso){
        //Cantidad de procesos esperando ser recibidos en Adquisiciones
        return $cantidad_procesos_enviados = DB::table('proceso_contractuals')
                    ->where('tipo_proceso', $nombreProceso)
                    ->Where('estado','Enviado al Área de Adquisiciones.')
                    ->count();
    }

    static function tiempo_promedio_llegada($nombreProceso, $idProceso){
        $contador_procesos_enviados_adquisiciones = 0;
        $tiempo_promedio_envio = 0;
        //Se buscan los procesos contractuales correspondientes al tipo de proceso.
        $procesos_contractuales=ProcesoContractual::where('tipo_proceso',$nombreProceso)->get();
        //Nombre de la primera etapa del tipo de proceso para determinar la fecha de llegada.
        $primera_etapa= DB::table('etapas')
                    ->where('tipo_procesos_id', $idProceso)
                    ->where('indice', 1)
                    ->value('nombre');
        //ID de la primera etapa del tipo de proceso para determinar la fecha de llegada.
        $id_primera_etapa= DB::table('etapas')
                    ->where('tipo_procesos_id', $idProceso)
                    ->where('indice', 1)
                    ->value('id');
        //Evaluando tiempos de los procesos que han llegado a la primera etapa.
        foreach ($procesos_contractuales as $proceso_contractual){
            //Busca en el historial el objeto que contiene el proceso contractual y que haya sido recibido en Adquisiciones.
            $historico_proceso_etapa = HistoricoProcesoEtapa::
                    where('proceso_contractual_id', $proceso_contractual->id)
                    ->where('etapas_id', $id_primera_etapa)
                    ->where('estado', $primera_etapa)
                    ->first();
            //Si aún no ha llegado a la primera etapa, se corta el ciclo.
            if (!$historico_proceso_etapa){
                break;
            }
            //Fecha de recepción del proceso en el Área de Adquisiciones.
            $fecha_envio_proceso = $historico_proceso_etapa->created_at;
            //Fecha de Creacion del proceso en el sistema.
            $fecha_creacion_proceso = $proceso_contractual->created_at;
            //Calcula el tiempo entre creación del proceso y el recibido en adquisiciones diffInDays, diffInHours, diffInMinutes, diffInSeconds.
            $intervalo_diferencia_fecha = $fecha_envio_proceso->diffInHours($fecha_creacion_proceso);
            //Acumula los tiempos de intervalos.
            $tiempo_promedio_envio = $tiempo_promedio_envio + $intervalo_diferencia_fecha;
            $contador_procesos_enviados_adquisiciones ++;
        }
        if ($contador_procesos_enviados_adquisiciones!=0){
            return (($tiempo_promedio_envio)/($contador_procesos_enviados_adquisiciones))." hora(s).";
        }else{
            return "No se logró calcular el tiempo promedio.";
        }
    }

    static function etapas_tipo_proceso($idTipoProceso){
        //Etapas correspondientes a las etapas del tipo de proceso.
        return $etapas=Etapa::where('tipo_procesos_id', $idTipoProceso)->orderBy('indice', 'asc')->get();
    }

    static function cantidad_procesos_etapa($nombreProceso, $etapaNombre){
        //Cantidad de procesos en la etapa.
        return $cantidadProcesosEnEtapa = DB::table('proceso_contractuals')
                    ->where('tipo_proceso', $nombreProceso)
                    ->where('estado', $etapaNombre)->count();
    }

    static function tiempo_promedio_etapa($nombreProceso, $idProceso, $etapaId, $etapaNombre, $etapaIndice){
        $contador_procesos = 0;
        $tiempo_promedio = 0;
        $procesos_contractuales=ProcesoContractual::where('tipo_proceso',$nombreProceso)->get();
        foreach ($procesos_contractuales as $proceso_contractual){
            $historico_proceso_etapa = HistoricoProcesoEtapa::
                        where('proceso_contractual_id', $proceso_contractual->id)
                        ->where('etapas_id', $etapaId)
                        ->where('estado', $etapaNombre)
                        ->first();
            if (!$historico_proceso_etapa){
                break;
            }
            $nombre_siguiente_etapa= DB::table('etapas')
                        ->where('tipo_procesos_id', $idProceso)
                        ->where('indice', ($etapaIndice)+ 1)
                        ->value('nombre');
            $id_siguiente_etapa= DB::table('etapas')
                        ->where('tipo_procesos_id', $idProceso)
                        ->where('indice', ($etapaIndice)+ 1)
                        ->value('id');
            $historico_proceso_siguiente_etapa = HistoricoProcesoEtapa::
            where('proceso_contractual_id', $proceso_contractual->id)
                ->where('etapas_id', $id_siguiente_etapa)
                ->where('estado', $nombre_siguiente_etapa)
                ->first();
            //Si aún no ha llegado a la etapa ó ha pasado, se corta el ciclo.
            if(!$historico_proceso_siguiente_etapa){
               break;
            }
            //Fecha de recepción del proceso en el Área de Adquisiciones.
            $fecha_siguiente_etapa = $historico_proceso_siguiente_etapa->created_at;
            //Fecha de Creacion del proceso en el sistema.
            $fecha_etapa_actual = $historico_proceso_etapa->created_at;
            //Calcula el tiempo entre creación del proceso y el recibido en adquisiciones diffInDays, diffInHours, diffInMinutes, diffInSeconds.
            $intervalo_diferencia_fecha = $fecha_siguiente_etapa->diffInHours($fecha_etapa_actual);
            //Acumula los tiempos de intervalos.
            $tiempo_promedio = $tiempo_promedio + $intervalo_diferencia_fecha;
            $contador_procesos ++;
        }
        if ($contador_procesos!=0){
            return (($tiempo_promedio)/($contador_procesos))." hora(s).";
        }else{
            return "No se logró calcular el tiempo promedio.";
        }
    }







}
