<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    public function testCrearUsuario(){
        $user = \App\User::find(1);
        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/usuarios')
            ->see($user->nombre);
        $this->visit('usuarios/create')
            ->type('Juan Pablo', 'nombre')
            ->type('Torres Mendoza', 'apellidos')
            ->type('juan_Torres82112@elpoli.edu.co','email')
            ->check('rol_secretario')
            ->check('rol_abogado')
            ->press('Crear usuario')
            ->seePageIs('/usuarios')
            ->seeText('juan_Torres82112@elpoli.edu.co')
            ->seeInDatabase('users', ['email' => 'juan_Torres82112@elpoli.edu.co']);
    }
    public function testCrearUsuarioPorControlador(){
        $this->withoutMiddleware();
        $response = $this->call('POST', '/usuarios', ['nombre' => 'Juan', 'apellidos' => 'Vásquez',
            'email'=>'juan_vásquez82101@elpoli.edu.co', 'rol_admin'=> '', 'rol_coordinador'=>'1', 'rol_secretario'=>'1',
            'rol_abogado'=>'', 'rol_gestorcontratacion'=>'', 'rol_gestornotificacion'=>'', 'rol_gestorafiliacion'=>'',
            'rol_gestorarchivo'=>'', 'rol_gestorpublicacion'=>'', 'rol_secretariotecnico'=>'1', 'rol_usuariogeneral'=>'']);
        $this->assertResponseStatus($response->status());
    }
    public function testActualizarUsuario(){
        $this->withoutMiddleware();
        $usuario= DB::table('users')->where('email', 'juan_Torres82112@elpoli.edu.co')->first();
        $this->call('PUT/'.$usuario->id, '/usuarios', ['nombre' => 'Juan Camilo', 'apellidos' => 'vargas',
            'email'=>'juan_vásquez82101@elpoli.edu.co', 'rol_admin'=> '', 'rol_coordinador'=>'', 'rol_secretario'=>'',
            'rol_abogado'=>'', 'rol_gestorcontratacion'=>'', 'rol_gestornotificacion'=>'', 'rol_gestorafiliacion'=>'',
            'rol_gestorarchivo'=>'', 'rol_gestorpublicacion'=>'', 'rol_secretariotecnico'=>'', 'rol_usuariogeneral'=>'0']);
    }
    public function testEliminarUsuario(){
        $this->withoutMiddleware();
        $usuario= DB::table('users')->where('email', 'juan_Torres82112@elpoli.edu.co')->first();
        $this->delete('/usuarios/'.$usuario->id);
        $this->dontSeeInDatabase('users', ['email' => 'juan_Torres82112@elpoli.edu.co']);
        $usuario= DB::table('users')->where('email', 'juan_vásquez82101@elpoli.edu.co')->first();
        $this->delete('/usuarios/'.$usuario->id);
        $this->dontSeeInDatabase('users', ['email' => 'juan_vásquez82101@elpoli.edu.co']);
    }
}
