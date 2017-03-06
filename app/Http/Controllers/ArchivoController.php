<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\DatoEtapa;
use App\HistoricoDatoEtapa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = 'archivo';
    public function index()
    {
        $descargas=DB::table('archivos')->get();
        return view($this->path.'.formulario', compact('descargas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $files = Input::file('file');
            $fileName=$files->getClientOriginalName();
            $path = public_path().'/uploads/';
            $fileType=$files->guessExtension();

            $dato_etapa_id = DB::table('dato_etapas')
                ->where('proceso_contractual_id', $request->proceso_contractual_id)
                ->where('requisitos_id', $request->requisito_id)
                ->value('id');
            if ($dato_etapa_id != null ){
                //Edita Dato de la Etapa
                if($files->move($path, $fileName.'-'.$request->requisito_id.$request->proceso_contractual_id.'.'.$fileType)){

                $dato_etapa = DatoEtapa::findOrFail($dato_etapa_id);
                unlink($path.$dato_etapa->valor.'-'.$request->requisito_id.$request->proceso_contractual_id.'.'.$dato_etapa->tipo);
                $dato_etapa->valor = $fileName;
                $dato_etapa->tipo=$fileType;
                $dato_etapa->user_id = \Auth::user()->id;
                $dato_etapa->save();
                //Guardando en el historial
                $historial_dato_etapa = new HistoricoDatoEtapa();
                $historial_dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                $historial_dato_etapa->valor = $fileName;
                $historial_dato_etapa->user_id = \Auth::user()->id;
                $historial_dato_etapa->requisitos_id = $request->requisito_id;
                $historial_dato_etapa->save();
                }

            }else{
                if($files->move($path, $fileName.'-'.$request->requisito_id.$request->proceso_contractual_id.'.'.$fileType)) {

                    //Crea Dato de la Etapa
                    $dato_etapa = new DatoEtapa();
                    $dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                    $dato_etapa->user_id = \Auth::user()->id;
                    $dato_etapa->valor = $fileName;
                    $dato_etapa->tipo=$fileType;
                    $dato_etapa->requisitos_id = $request->requisito_id;
                    $dato_etapa->save();
                    //Guardando en el historial
                    $historial_dato_etapa = new HistoricoDatoEtapa();
                    $historial_dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                    $historial_dato_etapa->valor = $fileName;
                    $historial_dato_etapa->user_id = \Auth::user()->id;;
                    $historial_dato_etapa->requisitos_id = $request->requisito_id;
                    $historial_dato_etapa->save();
                }
            }
            return view('datosetapas/modalsave');
        } catch(Exception $e){
        return "Fatal error -".$e->getMessage();
        }






    }


    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $file = Archivo::findOrFail($id);
            if(unlink($file->ruta.$file->nombre.'.'.$file->tipo)){
                $file->delete();
            }
            return back();

        }catch (Exception $exception){
            return "Error critical".$exception->getMessage();
        }
    }

    public function store_funcional(Request $request)
    {

        $files = Input::file('file');

        $fileName=$files->getClientOriginalName();
        $path = public_path().'/uploads/';
        $fileType=$files->guessExtension();
        $fileSize=$files->getClientSize()/1024;

        $file = new Archivo();
        $file->nombre = $fileName;
        $file->ruta = $path;
        $file->tipo = $fileType;
        $file->tamaño = $fileSize;
        if($files->move($path, $fileName.'.'.$fileType)){
            $file->save();
        }
    }


}


