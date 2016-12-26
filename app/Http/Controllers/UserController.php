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
        $data= User::all();
        return view($this->path.'.index', compact('data'));
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
            $user->save();
            //$user->roles()->attach(1);
            return redirect()->route('users.index');
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
        $user->save();
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('users.index');
        } catch(Exception $e){
            return "Fatal error -".$e->getMessage();
        }
    }
}
