<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndicadoresController extends Controller
{
    private $path='indicadores';

    public function index()
    {
        return view($this->path.'.index');
    }

    public function create()
    {

    }

}
