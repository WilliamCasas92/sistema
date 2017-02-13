<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
use Exception;

class UserController extends Controller
{
    private $path='user';

    public function index()
    {
        $users= User::all();
        return view($this->path.'.index', compact('users'));
    }

    public function create()
    {
        return view($this->path.'.create');
    }

    public function store(Request $request)
    {
        try{
            $user = new User();
            $user->nombre       = $request->nombre;
            $user->apellidos    = $request->apellidos;
            $user->email        = $request->email;
            if(User::select()->where('email','=', $user->email)->first()) {
                return back()->with('error', 'El correo que intenta ingresar ya existe en el sistema.');
            }
            $user->save();

            if ($request['rol_admin']){
                $user->roles()->attach(1);
            }
            if ($request['rol_coordinador']){
                $user->roles()->attach(2);
            }
            if ($request['rol_secretario']){
                $user->roles()->attach(3);
            }
            if ($request['rol_abogado']) {
                $user->roles()->attach(4);
            }
            if ($request['rol_gestorcontratacion']) {
                $user->roles()->attach(5);
            }
            if ($request['rol_gestornotificacion']) {
                $user->roles()->attach(6);
            }
            if ($request['rol_gestorafiliacion']) {
                $user->roles()->attach(7);
            }
            if ($request['rol_gestorarchivo']) {
                $user->roles()->attach(8);
            }
            if ($request['rol_gestorpublicacion']) {
                $user->roles()->attach(9);
            }
            return redirect()->route('users.index')->with('add', 'El usuario fue agregado con exito.');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
    public function show($id)
    {
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view($this->path.'.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->nombre       = $request->nombre;
        $user->apellidos    = $request->apellidos;
        $user->email    = $request->email;
        if($userAux=User::select()->where('email','=', $user->email)->first()) {
            if ($user->id <> $userAux->id) {
                Alert::message('El usuario ya existe en el sistema', 'danger');
                return back()->with('error', 'El correo que intenta ingresar ya existe en el sistema.');
            }
        }
        $user->save();
        $user->roles()->detach();
        if ($request['rol_admin']){
            $user->roles()->attach(1);
        }
        if ($request['rol_coordinador']){
            $user->roles()->attach(2);
        }
        if ($request['rol_secretario']){
            $user->roles()->attach(3);
        }
        if ($request['rol_abogado']) {
            $user->roles()->attach(4);
        }
        if ($request['rol_gestorcontratacion']) {
            $user->roles()->attach(5);
        }
        if ($request['rol_gestornotificacion']) {
            $user->roles()->attach(6);
        }
        if ($request['rol_gestorafiliacion']) {
            $user->roles()->attach(7);
        }
        if ($request['rol_gestorarchivo']) {
            $user->roles()->attach(8);
        }
        if ($request['rol_gestorpublicacion']) {
            $user->roles()->attach(9);
        }
        return redirect()->route('users.index')->with('add', 'El usuario fue actulizado con exito.');
    }

    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->roles()->detach();
            $user->delete();
            return redirect()->route('users.index');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
}
