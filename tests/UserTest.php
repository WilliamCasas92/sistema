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
    use WithoutMiddleware;

    public function testExample()
    {
        $user = \App\User::find(1);

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/usuarios')
            ->see($user->nombre);

        $this->visit('/usuarios/create')
            ->type('Juan Pablo', 'nombre')
            ->type('Torres Mendoza', 'apellidos')
            ->type('juan_vásquez82112@elpoli.edu.co','email')
            ->check('rol_secretario')
            ->check('rol_abogado')
            ->press('crear_usuario');
    }

}
