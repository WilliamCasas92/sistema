<?php

namespace App\Http\Controllers;

use App\Archivo;
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
        //$files2 = $request->file('file');
        $files = Input::file('file');
        //foreach ($files2 as $files)
        //{
           // if($files){
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
            //}


        //}
        /*
        foreach($files as $file){
            $fileName = $file->getClientOriginalName();
            $file->move($path, $fileName);
        }
         */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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


}
