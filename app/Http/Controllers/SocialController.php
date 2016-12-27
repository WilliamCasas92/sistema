<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Socialite;

class SocialController extends Controller {

    public function __construct(){
     $this->middleware('guest');
    }
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

       public function getSocialAuth()
       {
           if(!config("services.google")) abort('404');

           return Socialite::driver('google')->redirect();
       }


       public function getSocialAuthCallback()
       {
          $user = Socialite::driver('google')->user();
              $email=$user->email;
              $domain = explode('@', $email);
              if(strcmp($domain[1],'elpoli.edu.co')==0)
              {
                  if($registro = User::select()->where('email','=', $user->email)->first()){
                      Auth::login($registro);
                      //return ('home');
                      //return view('home', compact('registro'));
                  }
                  return ('No existe ningun usuario en el sistema con el email ingresado.');
              }else {
                  return 'Usted esta ingresando con un correo que no pertenece a la intitución.';
              }
       }
}