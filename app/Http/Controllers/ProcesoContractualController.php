<?php

namespace App\Http\Controllers;
use App\Notifications\CambioEstado;
use App\Notifications\CambioEtapa;
use App\Notifications\EstadoEnvio;
use App\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\ProcesoContractual;
use App\TipoProceso;
use App\ProcesoEtapa;
use App\HistoricoProcesoEtapa;
use App\Etapa;

class ProcesoContractualController extends Controller
{
    private $path = 'procesocontractual';
    public function index()
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
            ->orderBy('numero_cdp', 'desc')
            ->get();

        $tipos_procesos= TipoProceso::where('activo',1)->get();
        return view($this->path.'.index', compact('procesos_contractuales', 'tipos_procesos'));
    }

    public function create()
    {
        $tipos_procesos= TipoProceso::where('activo',1)->get();
        return view($this->path.'.create', compact('tipos_procesos'));
    }

    public function store(Request $request)
    {
        try{
            $proceso_contractual = new ProcesoContractual();
            $proceso_contractual->tipo_proceso      = $request->tipo_proceso;
            $proceso_contractual->numero_cdp        = $request->num_cdp;
            $proceso_contractual->year_cdp          = $request->year_cdp;
            $proceso_contractual->objeto            = $request->objeto;
            $proceso_contractual->valor             = $request->num_valor;
            $proceso_contractual->plazo             = $request->num_plazo;
            $proceso_contractual->dependencia       = $request->dependencia;
            if ($request['num_contrato']){
                $proceso_contractual->numero_contrato   = $request->num_contrato;
            }else{
                $proceso_contractual->numero_contrato   = '';
            }
            $proceso_contractual->nombre_supervisor  = $request->nombre_supervisor;
            $proceso_contractual->id_supervisor      = $request->id_supervisor;
            $proceso_contractual->email_supervisor   = $request->email_supervisor;
            $proceso_contractual->user_id            = \Auth::user()->id;
            $proceso_contractual->tipo_procesos_id   = DB::table('tipo_procesos')
                                                            ->where('nombre', $request->tipo_proceso)
                                                            ->where('activo', 1)
                                                            ->value('id');
            $proceso_contractual->estado             = 'Sin enviar al Área de Adquisiciones.';

            if(ProcesoContractual::select()
                    ->where('numero_cdp','=', $proceso_contractual->numero_cdp)
                    ->where('year_cdp', '=', $proceso_contractual->year_cdp )->first()) {
                return back()->with('error', 'El Proceso Contractual con CDP:'.$proceso_contractual->numero_cdp .' ya esta registrado en el sistema.');
            }else if(ProcesoContractual::select()
                    ->where('numero_contrato','=', $proceso_contractual->num_contrato)->first()) {
                return back()->with('error', 'El Numero de contrato:'.$proceso_contractual->numero_contrato .' ya esta registrado en otro proceso.');
            }

            if ($request['comite_docenciainv']){
                $proceso_contractual->comiteinterno             = $request->comite_docenciainv;
                $proceso_contractual->fecha_comiteinterno       = $request->date_aprobación1;
            }elseif($request['comite_extension']){
                $proceso_contractual->comiteinterno             = $request->comite_extension;
                $proceso_contractual->fecha_comiteinterno       = $request->date_aprobación1;
                }elseif ($request['comite_admin']){
                    $proceso_contractual->comiteinterno         = $request->comite_admin;
                    $proceso_contractual->fecha_comiteinterno   = $request->date_aprobación1;
                }else{
                $proceso_contractual->comiteinterno             ='0';
                $proceso_contractual->fecha_comiteinterno       = '';
            }

            if ($request['comite_rectoria']){
                $proceso_contractual->comiterectoria            = $request->comite_rectoria;
                $proceso_contractual->fecha_comiterectoria      = $request->date_aprobación2;
            } else {
                $proceso_contractual->comiterectoria            ='0';
                $proceso_contractual->fecha_comiterectoria      = '';
            }

            if ($request['comite_asesor']){
                $proceso_contractual->comiteasesor              = $request->comite_asesor;
                $proceso_contractual->fecha_comiteasesor        = $request->date_aprobación3;
            } else {
                $proceso_contractual->comiteasesor              ='0';
                $proceso_contractual->fecha_comiteasesor        = '';
            }

            if ($request['comite_ev']){
                $proceso_contractual->comiteevaluador           = $request->comite_ev;
                $proceso_contractual->fecha_comiteevaluador     = $request->date_aprobación4;
            } else {
                $proceso_contractual->comiteevaluador           ='0';
                $proceso_contractual->fecha_comiteevaluador     = '';
            }

            $proceso_contractual->save();
            return redirect()->route('consulta.mostrar');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $proceso_contractual = ProcesoContractual::findOrFail($id);
        $tipos_procesos= TipoProceso::where('activo',1)->get();
        return view($this->path.'.edit', compact('proceso_contractual', 'tipos_procesos'));
    }

    public function update(Request $request, $id)
    {
        $proceso_contractual = ProcesoContractual::findOrFail($id);
        $proceso_contractual->tipo_proceso      = $request->tipo_proceso;
        $proceso_contractual->numero_cdp        = $request->num_cdp;
        $proceso_contractual->objeto            = $request->objeto;
        $proceso_contractual->valor             = $request->num_valor;
        $proceso_contractual->plazo             = $request->num_plazo;
        $proceso_contractual->dependencia       = $request->dependencia;
        if ($request['num_contrato']){
            $proceso_contractual->numero_contrato   = $request->num_contrato;
        }else{
            $proceso_contractual->numero_contrato   = '';
        }
        $proceso_contractual->nombre_supervisor = $request->nombre_supervisor;
        $proceso_contractual->id_supervisor     = $request->id_supervisor;
        $proceso_contractual->email_supervisor  = $request->email_supervisor;

        if($proceso_contractualAux=ProcesoContractual::select()
                ->where('numero_cdp','=', $proceso_contractual->numero_cdp)
                ->where('year_cdp', '=', $proceso_contractual->year_cdp )->first()) {
            if ($proceso_contractual->id <> $proceso_contractualAux->id) {
                return back()->with('error', 'El Proceso Contractual con CDP:'.$proceso_contractual->numero_cdp .' ya esta registrado en el sistema.');
            }
        }
        if ($request['num_contrato']) {
            if ($proceso_contractualAux2 = ProcesoContractual::select()
                ->where('numero_contrato', '=', $proceso_contractual->numero_contrato)->first()
            ) {
                if ($proceso_contractual->id <> $proceso_contractualAux2->id) {
                    return back()->with('error', 'El Numero de contrato:' . $proceso_contractual->numero_contrato . ' ya esta registrado en otro proceso.');
                }
            }
        }
        if ($request['comite_docenciainv']){
            $proceso_contractual->comiteinterno         = $request->comite_docenciainv;
            $proceso_contractual->fecha_comiteinterno   = $request->date_aprobación1;
        }elseif($request['comite_extension']){
            $proceso_contractual->comiteinterno         = $request->comite_extension;
            $proceso_contractual->fecha_comiteinterno   = $request->date_aprobación1;
        }elseif ($request['comite_admin']){
            $proceso_contractual->comiteinterno         = $request->comite_admin;
            $proceso_contractual->fecha_comiteinterno   = $request->date_aprobación1;
        }else{
            $proceso_contractual->comiteinterno         ='0';
            $proceso_contractual->fecha_comiteinterno   = '';
        }
        if ($request['comite_rectoria']){
            $proceso_contractual->comiterectoria        = $request->comite_rectoria;
            $proceso_contractual->fecha_comiterectoria  = $request->date_aprobación2;
        } else {
            $proceso_contractual->comiterectoria        ='0';
            $proceso_contractual->fecha_comiterectoria  = '';
        }
        if ($request['comite_asesor']){
            $proceso_contractual->comiteasesor          = $request->comite_asesor;
            $proceso_contractual->fecha_comiteasesor    = $request->date_aprobación3;
        } else {
            $proceso_contractual->comiteasesor          ='0';
            $proceso_contractual->fecha_comiteasesor    = '';
        }
        if ($request['comite_ev']){
            $proceso_contractual->comiteevaluador       = $request->comite_ev;
            $proceso_contractual->fecha_comiteevaluador = $request->date_aprobación4;
        } else {
            $proceso_contractual->comiteevaluador       ='0';
            $proceso_contractual->fecha_comiteevaluador = '';
        }
        $proceso_contractual->save();
        return redirect()->route('consulta.mostrar');
    }

    public function destroy($id)
    {
        try{
            $proceso_contractual = ProcesoContractual::findOrFail($id);
            $proceso_contractual->delete();
            return redirect()->route('consulta.mostrar');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    //Función para enviar proceso a Adquisiciones.
    public function enviar($idproceso)
    {
        try{
            $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
            //Creando tabla proceso_etapa
            $proceso_etapa = new ProcesoEtapa();
            $proceso_etapa->proceso_contractual_id   = $idproceso;
            $proceso_etapa->etapas_id                = DB::table('etapas')
                    ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                    ->where('indice', 1)
                    ->value('id');
            $proceso_etapa->user_id                  = \Auth::user()->id;;
            $proceso_etapa->estado                   = 'Activo';
            $proceso_etapa->save();
            $proceso_contractual->estado             = 'Enviado al Área de Adquisiciones.';
            //Guardando en el historial
            $historial_proceso_etapa = new HistoricoProcesoEtapa();
            $historial_proceso_etapa->proceso_etapa_id          = $proceso_etapa->id;
            $historial_proceso_etapa->proceso_contractual_id    = $idproceso;
            $historial_proceso_etapa->etapas_id                 = $proceso_etapa->etapas_id;
            $historial_proceso_etapa->user_id                   = \Auth::user()->id;
            $historial_proceso_etapa->estado                    = $proceso_contractual->estado;
            $historial_proceso_etapa->save();
            $aux_proceso_contracual = $proceso_contractual;
            $proceso_contractual->save();
            $this->notificar_estado_envio($aux_proceso_contracual);

        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
        return back();
    }

    //Función para recibir proceso en Adquisiciones.
    public function recibir($idproceso)
    {
        try{
            $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
            //Creando tabla proceso_etapa
            $id_etapa   =DB::table('etapas')
                            ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                            ->where('indice', 1)
                            ->value('id');
            $proceso_etapa=ProcesoEtapa::
                            where('proceso_contractual_id', $idproceso)
                            ->where('etapas_id', $id_etapa)
                            ->first();
            $proceso_etapa->user_id                  = \Auth::user()->id;
            $proceso_etapa->save();

            $proceso_contractual->estado             = DB::table('etapas')
                ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                ->where('indice', 1)
                ->value('nombre');

            //Guardando en el historial
            $historial_proceso_etapa = new HistoricoProcesoEtapa();
            $historial_proceso_etapa->proceso_etapa_id          = $proceso_etapa->id;
            $historial_proceso_etapa->proceso_contractual_id    = $idproceso;
            $historial_proceso_etapa->etapas_id                 = $proceso_etapa->etapas_id;
            $historial_proceso_etapa->user_id                   = \Auth::user()->id;
            $historial_proceso_etapa->estado                    = $proceso_contractual->estado;
            $historial_proceso_etapa->save();
            $aux_proceso_contractual =$proceso_contractual;
            $proceso_contractual->save();
            $this->notificar_inicio($id_etapa, $aux_proceso_contractual);
            //Notificar que el proceso a sido recibido
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
        return back();
    }

    //Función para finalizar proceso en Adquisiciones.
    public function finalizar($idproceso, $idetapa)
    {
        try{
            $etapa=Etapa::findOrFail($idetapa);
            $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
            $contenido_validacion=$this->validar_datos_obligatorios($etapa->id, $proceso_contractual->id);
            if($contenido_validacion->resultado==true){
                $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
                $proceso_etapa=ProcesoEtapa::
                        where('proceso_contractual_id', $idproceso)
                        ->first();
                $proceso_etapa->user_id         = \Auth::user()->id;
                $proceso_etapa->estado          = "Finalizado";
                $proceso_etapa->save();
                $proceso_contractual->estado    = "Finalizado";
                //Guardando en el historial
                $historial_proceso_etapa = new HistoricoProcesoEtapa();
                $historial_proceso_etapa->proceso_etapa_id          = $proceso_etapa->id;
                $historial_proceso_etapa->proceso_contractual_id    = $idproceso;
                $historial_proceso_etapa->etapas_id                 = $proceso_etapa->etapas_id;
                $historial_proceso_etapa->user_id                   = \Auth::user()->id;
                $historial_proceso_etapa->estado                    = $proceso_contractual->estado;
                $historial_proceso_etapa->save();
                //Esta es la función que notifica por correo que el proceso ha finalizado
                $aux_proceso_contractual = $proceso_contractual;
                $proceso_contractual->save();
                $this->notificar_estado($aux_proceso_contractual);
                return view('datosetapas/procesofin');
            }
            return view('datosetapas/datosfaltantes', compact('contenido_validacion'));
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
        return back();
    }

    //Funcion de validar para finalizar proceso
    public function validar_datos_obligatorios($id_etapa, $id_proceso)
    {
        $contenido_validacion = new \stdClass();
        $datos = DB::table('dato_etapas')
                ->where('proceso_contractual_id', $id_proceso)
                ->join('requisitos', function ($join) use ($id_etapa) {
                    $join->on('dato_etapas.requisitos_id', '=', 'requisitos.id')
                        ->where('requisitos.etapas_id', '=', $id_etapa);
                })
                ->get();
        if ($datos->count()){
            foreach ($datos as $dato){
                if (($dato->obligatorio=='1') &&
                    ( ($dato->valor=='')||($dato->valor=='0')||($dato->valor==null))){
                    $contenido_validacion->mensaje      = 'Debe diligenciar el campo "'.$dato->nombre.'" para finalizar la etapa.';
                    $contenido_validacion->resultado    = false;
                    return $contenido_validacion;
                }
            }
        }else{
            $contenido_validacion->mensaje      = 'Debe guardar los datos antes de enviar a la siguiente etapa.';
            $contenido_validacion->resultado    = false;
            return $contenido_validacion;
        }
        $contenido_validacion->mensaje      = '';
        $contenido_validacion->resultado    = true;
        return $contenido_validacion;
    }

    //Función para desertar proceso en Adquisiciones.
    public function desertar($idproceso)
    {
        try{
            $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
            $proceso_etapa=ProcesoEtapa::
                    where('proceso_contractual_id', $idproceso)
                    ->first();
            $proceso_etapa->user_id         = \Auth::user()->id;
            $proceso_etapa->estado          = "Desierto";
            $proceso_etapa->save();
            $proceso_contractual->estado    = "Desierto";
            //Guardando en el historial
            $historial_proceso_etapa = new HistoricoProcesoEtapa();
            $historial_proceso_etapa->proceso_etapa_id          = $proceso_etapa->id;
            $historial_proceso_etapa->proceso_contractual_id    = $idproceso;
            $historial_proceso_etapa->etapas_id                 = $proceso_etapa->etapas_id;
            $historial_proceso_etapa->user_id                   = \Auth::user()->id;
            $historial_proceso_etapa->estado                    = $proceso_contractual->estado;
            $historial_proceso_etapa->save();
            $aux_proceso_contractual = $proceso_contractual;
            $proceso_contractual->save();
            //Notificar proceso desertado
            $this->notificar_estado($aux_proceso_contractual);

        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
        return back();
    }

    //Función para reanudar proceso en Adquisiciones.
    public function reanudar($idproceso)
    {
        try{
            $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
            $proceso_etapa=ProcesoEtapa::
                    where('proceso_contractual_id', $idproceso)
                    ->first();
            $proceso_etapa->user_id         = \Auth::user()->id;
            $proceso_etapa->estado          = "Activo";
            $proceso_etapa->etapas_id                = DB::table('etapas')
                    ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                    ->where('indice', 1)
                    ->value('id');
            $proceso_etapa->save();
            $proceso_contractual->estado             = DB::table('etapas')
                    ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                    ->where('indice', 1)
                    ->value('nombre');
            //Guardando en el historial Reanudado y comienzo deste primera etapa.
            $historial_proceso_etapa = new HistoricoProcesoEtapa();
            $historial_proceso_etapa->proceso_etapa_id          = $proceso_etapa->id;
            $historial_proceso_etapa->proceso_contractual_id    = $idproceso;
            $historial_proceso_etapa->etapas_id                 = $proceso_etapa->etapas_id;
            $historial_proceso_etapa->user_id                   = \Auth::user()->id;
            $historial_proceso_etapa->estado                    = "Reanudado";
            $historial_proceso_etapa->save();
            $aux_proceso_contractual =$proceso_contractual;
            $proceso_contractual->save();
            //Notificar que el proceso sea reanudado
            $this->notificar_estado($aux_proceso_contractual);
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
        return back();
    }

    //Usuario puede acceder a diligenciar datos de la etapa.
    static function etapa_usuario($proceso_estado, $tipo_proceso_id)
    {
        if( (\Auth::user()->hasRol('Administrador'))||(\Auth::user()->hasRol('Coordinador')) ){
            return true;
        }
        if( (\Auth::user()->hasRol('Secretario técnico de dependencia')&&($proceso_estado=='Sin enviar al Área de Adquisiciones.')) ){
            return $proceso_estado;
        }
        if( (\Auth::user()->hasRol('Secretario')&&($proceso_estado=='Enviado al Área de Adquisiciones.')) ){
            return $proceso_estado;
        }
        if(\Auth::user()->hasRol('Secretario')){
            $etapas= Etapa::all();
            foreach ($etapas as $etapa){
                if($etapa->hasRol('Secretario')&&($etapa->nombre==$proceso_estado)&&($etapa->tipo_procesos_id==$tipo_proceso_id)){
                    return $proceso_estado;
                }
            }
        }
        if(\Auth::user()->hasRol('Abogado')){
            $etapas= Etapa::all();
            foreach ($etapas as $etapa){
                if($etapa->hasRol('Abogado')&&($etapa->nombre==$proceso_estado)&&($etapa->tipo_procesos_id==$tipo_proceso_id)){
                    return $proceso_estado;
                }
            }
        }
        if(\Auth::user()->hasRol('Gestor de contratación')){
            $etapas= Etapa::all();
            foreach ($etapas as $etapa){
                if($etapa->hasRol('Gestor de contratación')&&($etapa->nombre==$proceso_estado)&&($etapa->tipo_procesos_id==$tipo_proceso_id)){
                    return $proceso_estado;
                }
            }
        }
        if(\Auth::user()->hasRol('Gestor de notificación')){
            $etapas= Etapa::all();
            foreach ($etapas as $etapa){
                if($etapa->hasRol('Gestor de notificación')&&($etapa->nombre==$proceso_estado)&&($etapa->tipo_procesos_id==$tipo_proceso_id)){
                    return $proceso_estado;
                }
            }
        }
        if(\Auth::user()->hasRol('Gestor de afiliación')){
            $etapas= Etapa::all();
            foreach ($etapas as $etapa){
                if($etapa->hasRol('Gestor de afiliación')&&($etapa->nombre==$proceso_estado)&&($etapa->tipo_procesos_id==$tipo_proceso_id)){
                    return $proceso_estado;
                }
            }
        }
        if(\Auth::user()->hasRol('Gestor de archivo')){
            $etapas= Etapa::all();
            foreach ($etapas as $etapa){
                if($etapa->hasRol('Gestor de archivo')&&($etapa->nombre==$proceso_estado)&&($etapa->tipo_procesos_id==$tipo_proceso_id)){
                    return $proceso_estado;
                }
            }
        }
        if(\Auth::user()->hasRol('Gestor de publicación')){
            $etapas= Etapa::all();
            foreach ($etapas as $etapa){
                if($etapa->hasRol('Gestor de publicación')&&($etapa->nombre==$proceso_estado)&&($etapa->tipo_procesos_id==$tipo_proceso_id)){
                    return $proceso_estado;
                }
            }
        }
    }

    public function notificar_estado(ProcesoContractual $proceso_contractual){
        $id_rol_administrador=1;
        $id_usuarios =DB::table('users')
            ->join('user_rol', function ($join) use ($id_rol_administrador)  {
                $join->on('users.id', '=', 'user_rol.user_id')
                    ->where('user_rol.rol_id', '=', $id_rol_administrador);
            })
            ->select('users.id')
            ->get();
        foreach ($id_usuarios as $id_usuario){
            $usuario=User::find($id_usuario->id);
            $usuario->notify(new CambioEstado($proceso_contractual));
        }
        return;
    }

    public function notificar_estado_envio(ProcesoContractual $proceso_contractual){
        $id_rol_administrador=1;
        $id_rol_secretario=0;
        $id_usuarios =DB::table('users')
            ->join('user_rol', function ($join) use ($id_rol_administrador)  {
                $join->on('users.id', '=', 'user_rol.user_id')
                    ->where('user_rol.rol_id', '=', $id_rol_administrador)
                    ->orwhere('user_rol.rol_id', '=', $id_rol_administrador);

            })
            ->select('users.id')
            ->distinct()
            ->get();
        foreach ($id_usuarios as $id_usuario){
            $usuario=User::find($id_usuario->id);
            $usuario->notify(new EstadoEnvio($proceso_contractual));
        }
        return;
    }

    public function notificar_inicio($id_etapa_actual, ProcesoContractual $proceso_contractual)
    {
        // se realiza la consulta dei id los usuarios que tienen roles asociados a la etapa del proceso
        $id_usuarios=DB::table('etapa_rol')
            ->where('etapa_id', $id_etapa_actual)
            ->join('rols', function ($join)  {
                $join->on('etapa_rol.rol_id', '=', 'rols.id');
            })
            ->join('user_rol', function ($join)  {
                $join->on('rols.id', '=', 'user_rol.rol_id');
            })
            ->join('users', function ($join)  {
                $join->on('user_rol.user_id', '=', 'users.id');
            })
            ->select('users.id')
            ->distinct()
            ->get();


        //Se busca la entidad de la etapa actual
        $etapa_actual= Etapa::findOrFail($id_etapa_actual);
        //Se busca el nombre de la etapa anterior
        $nombre_etapa_anterior= "Recibido en el Área de Adquisiciones";
        //Se realiza un foreach para buscar los usuarios con el id asociado a la etapa del proceso
        foreach ($id_usuarios as $id_usuario){
            $roles_usurio_etapa ="";
            //Se realiza la busquedad del usuario con su id
            $usuario = User::find($id_usuario->id);
            //Se buscan los roles asociados con la etapa y el usuario
            $roles=DB::table('etapa_rol')
                ->where('etapa_id', $etapa_actual->id )
                ->join('rols', function ($join)  {
                    $join->on('etapa_rol.rol_id', '=', 'rols.id');
                })
                ->join('user_rol', function ($join) use ($usuario)  {
                    $join->on('rols.id', '=', 'user_rol.rol_id')
                        ->where('user_rol.user_id', '=', $usuario->id);
                })
                ->select('rols.nombre')
                ->get();
            //Concatenan los roles de los usuarios para ser enviados al contralador cambio de etapa
            foreach ($roles as $rol){
                $roles_usurio_etapa .= $rol->nombre." ";
            }
            //Se dice cual es el usuario que se desea notificar y con los datos para enviar por correo
            //Nombre de la etapa anterior entidad proceso contractual y los roles asociados al usuario
            $usuario->notify(new CambioEtapa($proceso_contractual, $nombre_etapa_anterior, $roles_usurio_etapa));
        }
        return;

    }

    static function procesos_contractuales(){
        return ProcesoContractual::all();
    }

}
