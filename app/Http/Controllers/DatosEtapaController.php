<?php

namespace App\Http\Controllers;


use App\Observacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ProcesoContractual;
use App\TipoProceso;
use App\Etapa;
use App\Requisito;
use App\TipoRequisito;
use App\DatoEtapa;
use App\HistoricoProcesoEtapa;
use App\HistoricoDatoEtapa;
use App\ProcesoEtapa;
use App\Notifications\CambioEtapa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use PhpParser\Node\Expr\New_;
use App\User;

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
        $observaciones = Observacion::where('proceso_contractual_id',$proceso_contractual_id)->orderBy('created_at','desc')->get();
        //$datos_etapas_proceso=DatoEtapa::where('proceso_contractual_id', $proceso_contractual->id)->get();
        return view($this->path.'.menu', compact('proceso_contractual', 'etapas', 'requisitos', 'observaciones'));
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
                $requisito=Requisito::findOrFail($request->requisito_id[$cont]);

                if ($dato_etapa_id != null) {
                    if($requisito->tipo_requisitos_id != 3) {
                        //Edita Dato de la Etapa
                        $dato_etapa = DatoEtapa::findOrFail($dato_etapa_id);
                        $valor_anterior = $dato_etapa->valor;
                        $dato_etapa->valor = $atributo_;
                        $dato_etapa->user_id = \Auth::user()->id;
                        $dato_etapa->save();
                        if($valor_anterior != $atributo_) {
                            //Guardando en el historial
                            $historial_dato_etapa = new HistoricoDatoEtapa();
                            $historial_dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                            $historial_dato_etapa->valor = $atributo_;
                            $historial_dato_etapa->dato_etapa_id = $dato_etapa_id;
                            $historial_dato_etapa->user_id = \Auth::user()->id;
                            $historial_dato_etapa->requisitos_id = $request->requisito_id[$cont];
                            $historial_dato_etapa->save();
                        }
                        $cont++;
                    }else{
                        $cont++;
                    }
                } else {
                    //Crea Dato de la Etapa
                    $dato_etapa = new DatoEtapa();
                    $dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                    $dato_etapa->user_id = \Auth::user()->id;
                    $dato_etapa->valor = $atributo_;
                    $dato_etapa->requisitos_id = $request->requisito_id[$cont];
                    $dato_etapa->save();
                    //Guardando en el historial
                    if($dato_etapa->valor) {
                        $historial_dato_etapa = new HistoricoDatoEtapa();
                        $historial_dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                        $ultimo_dato_etapa= DatoEtapa::all()->last();
                        $historial_dato_etapa->dato_etapa_id = $ultimo_dato_etapa->id;
                        $historial_dato_etapa->valor = $atributo_;
                        $historial_dato_etapa->user_id = \Auth::user()->id;
                        $historial_dato_etapa->requisitos_id = $request->requisito_id[$cont];
                        $historial_dato_etapa->save();

                    }
                    $cont++;
                }
            }
            return " ";
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

    static function busqueda_tipo_dato_etapa($proceso_id, $req_id)
    {
        $tipo = DB::table('dato_etapas')
            ->where('proceso_contractual_id', $proceso_id)
            ->where('requisitos_id', $req_id)
            ->value('tipo');
        return $tipo;
    }

    public function enviar_etapa($idproceso, $idetapa)
    {
        try{
            $etapa=Etapa::findOrFail($idetapa);
            $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
            $contenido_validacion=$this->validar_datos_obligatorios($etapa->id, $proceso_contractual->id);
            if($contenido_validacion->resultado==true){
                //Actualizando tabla proceso_etapa
                $proceso_etapa=ProcesoEtapa::
                where('proceso_contractual_id', $idproceso)
                    ->where('etapas_id', $idetapa)
                    ->first();
                $id_nextetapa= DB::table('etapas')
                    ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                    ->where('indice', $etapa->indice + 1)
                    ->value('id');
                $proceso_etapa->etapas_id  =$id_nextetapa;
                $proceso_etapa->user_id                  = \Auth::user()->id;




                $nextetapa= DB::table('etapas')
                    ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
                    ->where('indice', $etapa->indice + 1)
                    ->value('nombre');

                $proceso_contractual->estado             = $nextetapa;
                $proceso_contractual->save();
                //Guardando en el historial
                $historial_proceso_etapa = new HistoricoProcesoEtapa();
                $historial_proceso_etapa->proceso_etapa_id  = $proceso_etapa->id;
                $historial_proceso_etapa->proceso_contractual_id = $proceso_etapa->proceso_contractual_id;
                $historial_proceso_etapa->etapas_id         = $proceso_etapa->etapas_id;
                $historial_proceso_etapa->user_id           = \Auth::user()->id;
                $historial_proceso_etapa->estado            = $nextetapa;
                $historial_proceso_etapa->save();
                $proceso_etapa->save();
                //En esta instrucción se notifica por correo a los usuarios que estan involucrados en la siguiente etapa, sobre el cambio de etapa
                $this->notificar_cambio_etapa($id_nextetapa, $idproceso);

                return view('datosetapas/pasoetapa');
            }
            return view('datosetapas/datosfaltantes', compact('contenido_validacion'));
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

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

    //Esta es la función donde se suben los documentos a la aplicación
    public function subir_documento(Request $request){
        try {
            $files = Input::file('file');
            $fileName = $files->getClientOriginalName();
            $path = public_path() . '/uploads/';
            $fileType = $files->guessExtension();

            $dato_etapa_id = DB::table('dato_etapas')
                ->where('proceso_contractual_id', $request->proceso_contractual_id)
                ->where('requisitos_id', $request->requisito_id)
                ->value('id');
            if ($dato_etapa_id != null) {
                if ($files->move($path, $fileName . '-' . $request->requisito_id . '-' . $request->proceso_contractual_id . '.' . $fileType)) {

                    $dato_etapa = DatoEtapa::findOrFail($dato_etapa_id);
                    if($dato_etapa->valor !=  $fileName) {
                        if (file_exists($path . $dato_etapa->valor . '-' . $request->requisito_id . '-' . $request->proceso_contractual_id . '.' . $dato_etapa->tipo)) {
                            unlink($path . $dato_etapa->valor . '-' . $request->requisito_id . '-' . $request->proceso_contractual_id . '.' . $dato_etapa->tipo);
                        }
                    }
                    $dato_etapa->valor = $fileName;
                    $dato_etapa->tipo = $fileType;
                    $dato_etapa->user_id = \Auth::user()->id;
                    $dato_etapa->save();
                    //Guardando en el historial
                    $historial_dato_etapa = new HistoricoDatoEtapa();
                    $historial_dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                    $historial_dato_etapa->dato_etapa_id = $dato_etapa_id;
                    $historial_dato_etapa->valor = $fileName;
                    $historial_dato_etapa->user_id = \Auth::user()->id;
                    $historial_dato_etapa->requisitos_id = $request->requisito_id;
                    $historial_dato_etapa->save();
                }

            } else {
                $requistos = Requisito::where('etapas_id', $request->etapa_id)->get();
                //Edita Dato de la Etapa
                foreach ($requistos as $requisto)
                    if ($requisto->id == $request->requisito_id) {
                        if ($files->move($path, $fileName . '-' . $request->requisito_id . '-' . $request->proceso_contractual_id . '.' . $fileType)) {

                            //Crea Dato de la Etapa
                            $dato_etapa = new DatoEtapa();
                            $dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                            $dato_etapa->user_id = \Auth::user()->id;
                            $dato_etapa->valor = $fileName;
                            $dato_etapa->tipo = $fileType;
                            $dato_etapa->requisitos_id = $request->requisito_id;
                            $dato_etapa->save();
                            //Guardando en el historial
                            $historial_dato_etapa = new HistoricoDatoEtapa();
                            $historial_dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                            $historial_dato_etapa->valor = $fileName;
                            $ultimo_dato_etapa= DatoEtapa::all()->last();
                            $historial_dato_etapa->dato_etapa_id = $ultimo_dato_etapa->id;
                            $historial_dato_etapa->user_id = \Auth::user()->id;;
                            $historial_dato_etapa->requisitos_id = $request->requisito_id;
                            $historial_dato_etapa->save();
                        }
                    } else {
                        //Crea Dato de la Etapa
                        $dato_etapa = new DatoEtapa();
                        $dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                        $dato_etapa->user_id = \Auth::user()->id;
                        $dato_etapa->valor = "";
                        $dato_etapa->requisitos_id = $requisto->id;
                        $dato_etapa->save();
                        //No es necesario guardar historial de los campos que crea en blanco
                    }
            }
            //return view('datosetapas/modalsave');
            return ('<h5>'.'<a href="/uploads/'.$fileName.'-'.$request->requisito_id.'-'.$request->proceso_contractual_id.'.'.$fileType.'" download="'.$fileName.'">'.$fileName.'</a></h5>');
        } catch (Exception $e) {
            return "Fatal error -" . $e->getMessage();
        }
    }

    //Esta función elimina el documento de la base de datos y deja vacio el registro que contenia el nombre
    public function eliminar_documento($idproceso, $idrequisito)
    {
        //En este se elimina el documento y se actuliza el registro en la base de datos como vacio
        $path = public_path() . '/uploads/';
        $dato_etapa_id = DB::table('dato_etapas')
            ->where('proceso_contractual_id', $idproceso)
            ->where('requisitos_id', $idrequisito)
            ->value('id');

        $dato_etapa = DatoEtapa::findOrFail($dato_etapa_id);
        unlink($path . $dato_etapa->valor . '-' . $idrequisito . '-' . $idproceso . '.' . $dato_etapa->tipo);
        $dato_etapa->valor = "";
        $dato_etapa->tipo = "";
        $dato_etapa->user_id = \Auth::user()->id;
        $dato_etapa->save();
        //Guardando en el historial
        $historial_dato_etapa = new HistoricoDatoEtapa();
        $historial_dato_etapa->proceso_contractual_id = $idproceso;
        $historial_dato_etapa->dato_etapa_id = $dato_etapa_id;
        $historial_dato_etapa->valor = "Elimino";
        $historial_dato_etapa->user_id = \Auth::user()->id;
        $historial_dato_etapa->requisitos_id = $idrequisito;
        $historial_dato_etapa->save();
        return ('');
    }

    public function notificar_cambio_etapa($id_etapa_actual, $idproceso)
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

        //Se busca el proceso contractual
        $proceso_contractual = ProcesoContractual::findOrFail($idproceso);
        //Se busca la entidad de la etapa actual
        $etapa_actual= Etapa::findOrFail($id_etapa_actual);
        //Se busca el nombre de la etapa anterior
        $nombre_etapa_anterior= DB::table('etapas')
            ->where('tipo_procesos_id', $proceso_contractual->tipo_procesos_id )
            ->where('indice', $etapa_actual->indice - 1)
            ->value('nombre');
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
}
