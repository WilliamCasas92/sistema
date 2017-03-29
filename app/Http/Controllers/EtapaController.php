<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;
use App\Etapa;
use App\Requisito;
use App\TipoRequisito;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class EtapaController extends Controller
{
    private $path = 'etapa';
    public function index()
    {
        //$data = Etapa::all();
        //return view($this->path.'.index', compact('data'));
    }
    //este metodo es con el cual se muestran las etapas con los requisitos
    public function almacenar($id)
    {
        $etapas=Etapa::where('tipo_procesos_id', $id)->orderBy('indice', 'asc')->get();
        $requisitos=Requisito::all();
        //return view($this->path.'.almacenar', compact('data', 'id', 'data1'));
        return view($this->path.'.almacenar', compact('etapas', 'id', 'requisitos'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        try{
            $etapa = new Etapa();
            $etapa->nombre       = $request->nombre;
            $etapa->tipo_procesos_id = $request->idtipoproceso;
            //En este se cuenta el numero de etapas que existen en proceso para añadir el indice a la etapa
            $indice = $this->contar_etapas($request->idtipoproceso);
            //Despues de contar el número de etapas, este suma uno más para asignarse a la nueva etapa
            $etapa->indice = $indice +1 ;
            $etapa->save();

            $etapa->roles()->detach();
            $etapa->roles()->attach(1);
            if ($request['rol_coordinador']){
                $etapa->roles()->attach(2);
            }
            if ($request['rol_secretario']){
                $etapa->roles()->attach(3);
            }
            if ($request['rol_abogado']) {
                $etapa->roles()->attach(4);
            }
            if ($request['rol_gestorcontratacion']) {
                $etapa->roles()->attach(5);
            }
            if ($request['rol_gestornotificacion']) {
                $etapa->roles()->attach(6);
            }
            if ($request['rol_gestorafiliacion']) {
                $etapa->roles()->attach(7);
            }
            if ($request['rol_gestorarchivo']) {
                $etapa->roles()->attach(8);
            }
            if ($request['rol_gestorpublicacion']) {
                $etapa->roles()->attach(9);
            }
            return $this->mostrar($request->idtipoproceso);
            //return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $etapa = Etapa::findOrFail($id);
        //return view($this->path.'.index', compact('etapa'));
       // $data=Etapa::where('tipo_procesos_id', $id)->get();
        //$data1=Requisito::all();
        return view($this->path.'.modalrol', compact('etapa'));
    }

    public function update(Request $request, $id)
    {
        try{
            $etapa = Etapa::findOrFail($id);
            $etapa->save();

            $etapa->roles()->detach();
            $etapa->roles()->attach(1);

            if ($request['rol_coordinador']){
                $etapa->roles()->attach(2);
            }
            if ($request['rol_secretario']){
                $etapa->roles()->attach(3);
            }
            if ($request['rol_abogado']) {
                $etapa->roles()->attach(4);
            }
            if ($request['rol_gestorcontratacion']) {
                $etapa->roles()->attach(5);
            }
            if ($request['rol_gestornotificacion']) {
                $etapa->roles()->attach(6);
            }
            if ($request['rol_gestorafiliacion']) {
                $etapa->roles()->attach(7);
            }
            if ($request['rol_gestorarchivo']) {
                $etapa->roles()->attach(8);
            }
            if ($request['rol_gestorpublicacion']) {
                $etapa->roles()->attach(9);
            }
            return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function destroy($id)
    {
        try{
            $etapa = Etapa::findOrFail($id);
            $etapa->roles()->detach();
            $idProceso = $etapa->tipo_procesos_id;
            $indiceEtapa= $etapa->indice;
            $etapa->delete();
            $numEtapas = $indice = $this->contar_etapas($idProceso);
            while($indiceEtapa <= $numEtapas) {
                $auxEtapa = Etapa::where('tipo_procesos_id', $idProceso)->where('indice', $indiceEtapa + 1)->first();
                $auxEtapa->indice = $indiceEtapa;
                $auxEtapa->save();
                $indiceEtapa = ++$indiceEtapa;
            }
            return $this->mostrar($idProceso);
            //return redirect()->back();
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    static function buscar_tipos_requisitos()
    {
        $tipos_requisitos=TipoRequisito::all();
        return $tipos_requisitos;
    }

    public function subir_etapa($id)
    {
        try{
            $etapa = Etapa::findOrFail($id);
            $idProceso = $etapa->tipo_procesos_id;
            if($etapa->indice > 1) {
                $auxEtapa = Etapa::where('tipo_procesos_id', $etapa->tipo_procesos_id)->where('indice', $etapa->indice - 1)->first();
                $auxIndice = $etapa->indice;
                $etapa->indice = $auxEtapa->indice;
                $auxEtapa->indice = $auxIndice;
                $etapa->save();
                $auxEtapa->save();
            }
            return $this->mostrar($idProceso);
        }catch (Exception $exception){
            return "Error al cambiar el index de la etapa".$exception->getMessage();
        }
    }

    public function bajar_etapa($id)
    {
        try{
            $etapa = Etapa::findOrFail($id);
            $indice = $this->contar_etapas($etapa->tipo_procesos_id);
            $idProceso = $etapa->tipo_procesos_id;
            if($etapa->indice < $indice) {
                //$auxEtapa= Etapa::where(['tipo_procesos_id',$etapa->idtipoproceso], ['indice', $etapa->indice + 1])->get();
                $auxEtapa = Etapa::where('tipo_procesos_id', $etapa->tipo_procesos_id)->where('indice', $etapa->indice + 1)->first();
                $auxIndice = $etapa->indice;
                $etapa->indice = $auxEtapa->indice;
                $auxEtapa->indice = $auxIndice;
                $etapa->save();
                $auxEtapa->save();
            }
            return $this->mostrar($idProceso);
        }catch (Exception $exception){
            return "Error al cambiar el index de la etapa".$exception->getMessage();
        }
    }
    //Esta función envia las etapas para ser en la vistar index etapas
    public function mostrar($id){
        $etapas=Etapa::where('tipo_procesos_id', $id)->orderBy('indice', 'asc')->get();
        $requisitos=Requisito::all();
        return view($this->path.'.index', compact('etapas', 'requisitos'));
    }

    public  function contar_etapas($idProceso){
        return Etapa::where('tipo_procesos_id',$idProceso )->count();
    }
}
