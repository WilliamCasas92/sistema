<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        return redirect('/');
        //return redirect('https://mail.google.com/a/elpoli.edu.co/');
    }

}
