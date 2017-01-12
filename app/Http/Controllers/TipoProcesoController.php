<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProceso;

class TipoProcesoController extends Controller
{
    private $path = 'tipoproceso';
    public function index()
    {
        $data = TipoProceso::all();
        return view($this->path.'.index', compact('data'));
    }

    public function create()
    {
        return view($this->path.'.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
