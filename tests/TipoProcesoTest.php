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
    public function testExample()
    {
        $this->withoutMiddleware();

        $response = $this->call('POST', '/tipoproceso', ['nombre' => 'Proceso Prueba', 'version' => '2','activo'=>'1' ]);
        $this->assertEquals(302, $response->status());
    }
}
