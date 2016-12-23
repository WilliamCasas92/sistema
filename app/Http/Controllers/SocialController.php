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

       public function getSocialAuth($provider=null)
       {
           if(!config("services.$provider")) abort('404');

           return Socialite::driver($provider)->redirect();
       }


       public function getSocialAuthCallback($provider=null)
       {
          $user = Socialite::driver($provider)->user();
              $email=$user->email;
              $domain = explode('@', $email);
              if(strcmp($domain[1],'elpoli.edu.co')==0)
              {
                  return 'bienvenido estudiante del politecnico Jaime isaza Cadavid';
              }else {

                  return 'ingreso con un correo que no pertenece a la intitución';
              }
       }
}