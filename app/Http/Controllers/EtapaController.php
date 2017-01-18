<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;
use App\Etapa;

class EtapaController extends Controller
{
    private $path = 'etapa';
    public function index()
    {
        //$data = Etapa::all();
        //return view($this->path.'.index', compact('data'));
    }

    public function create()
    {
        $data=Etapa::all();
        return view($this->path.'.create', compact('data'));
    }


    public function store(Request $request)
    {
        try{
            $etapa = new Etapa();
            $etapa->nombre       = $request->nombre;
            if(Etapa::select()->where('nombre','=', $etapa->nombre)->first()) {
                return back()->with('msj', 'El nombre que intenta ingresar ya existe en el sistema.');
            }
            $etapa->save();
            return redirect()->route('etapa.create');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }

    public function show($id)
    {
        //
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
        //
    }
}
