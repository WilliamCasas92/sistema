<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcesoContractualController extends Controller
{
    private $path = 'procesocontractual';
    public function index()
    {
        return view($this->path.'.index');
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
