<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TipoProcesoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCrearTipoProcesoControlador()
    {
        $this->withoutMiddleware();

        $response = $this->call('POST', '/tipoproceso', ['nombre' => 'Proceso Prueba', 'version' => '1','activo'=>'1' ]);
        $this->assertResponseStatus($response->status());
    }


    public function testCrearTipoFormulario()
    {
        $user = \App\User::find(1);

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/usuarios')
            ->see($user->nombre);

        $this->visit('tipoproceso/create')
            ->type('Proceso Prueba', 'nombre')
            ->type('2', 'version')
            ->press('Crear Tipo de Proceso de Contratación')
            ->seePageIs('tipoproceso/create')
            ->seeText('Proceso Prueba')
            ->seeInDatabase('tipo_procesos', ['nombre' => 'Proceso Prueba', 'version'=>'2']);
    }
}
