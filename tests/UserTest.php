<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testExample()
    {
        $user = \App\User::find(1);

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/usuarios')
            ->see($user->nombre);

        $this->visit('usuarios/create')
            ->type('Juan Pablo', 'nombre')
            ->type('Torres Mendoza', 'apellidos')
            ->type('juan_vásquez82112@elpoli.edu.co','email')
            ->check('rol_secretario')
            ->check('rol_abogado')
            ->press('Crear usuario')
            ->seePageIs('/usuarios');

        $response = $this->call('POST', '/usuarios', ['nombre' => 'Juan', 'apellidos' => 'Vásquez',
            'email'=>'juan_vásquez82101@elpoli.edu.co', 'rol_admin'=> '', 'rol_coordinador'=>'1', 'rol_secretario'=>'1',
            'rol_abogado'=>'', 'rol_gestorcontratacion'=>'', 'rol_gestornotificacion'=>'', 'rol_gestorafiliacion'=>'',
            'rol_gestorarchivo'=>'', 'rol_gestorpublicacion'=>'', 'rol_secretariotecnico'=>'1', 'rol_usuariogeneral'=>'']);

        $this->assertResponseStatus( $response->status());

    }

}
