<?php

namespace App\Http\Controllers;

use App\HistoricoProcesoEtapa;
use App\ProcesoEtapa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\User;
use Socialite;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('acerca');
    }

    public function desconexion(){
        Auth::logout();
        Session::flush();
        return redirect('https://mail.google.com/a/elpoli.edu.co/');
    }

    static function buscar_proceso_etapa($proceso_id){
        $proceso_etapa = ProcesoEtapa::find($proceso_id);
        if (!$proceso_etapa){
            return 0;
        }else{
            return $fecha = $proceso_etapa->updated_at->format('l d \d\e F \d\e Y, h:i:s A');
        }
    }
}
