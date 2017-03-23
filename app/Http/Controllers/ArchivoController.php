<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\DatoEtapa;
use App\HistoricoDatoEtapa;
use App\Requisito;
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
        $descargas = DB::table('archivos')->get();
        return view($this->path . '.formulario', compact('descargas'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

                    if (file_exists($path . $dato_etapa->valor . '-' . $request->requisito_id . '-' . $request->proceso_contractual_id . '.' . $dato_etapa->tipo)) {
                        unlink($path . $dato_etapa->valor . '-' . $request->requisito_id . '-' . $request->proceso_contractual_id . '.' . $dato_etapa->tipo);
                    }
                    $dato_etapa->valor = $fileName;
                    $dato_etapa->tipo = $fileType;
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
                        //Guardando en el historial
                        $historial_dato_etapa = new HistoricoDatoEtapa();
                        $historial_dato_etapa->proceso_contractual_id = $request->proceso_contractual_id;
                        $historial_dato_etapa->valor = "";
                        $historial_dato_etapa->user_id = \Auth::user()->id;;
                        $historial_dato_etapa->requisitos_id = $requisto->id;
                        $historial_dato_etapa->save();
                    }
            }
            //return view('datosetapas/modalsave');
            return ($dato_etapa_id);
        } catch (Exception $e) {
            return "Fatal error -" . $e->getMessage();
        }

    }


    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id){


    }

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
        $historial_dato_etapa->valor = "";
        $historial_dato_etapa->user_id = \Auth::user()->id;
        $historial_dato_etapa->requisitos_id = $idrequisito;
        $historial_dato_etapa->save();
        return ('El documento se elimino con exito');
    }




}


