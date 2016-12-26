<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_admin = new Rol();
        $rol_admin->nombre='Administrador';
        $rol_admin->descripcion='Administrador de la aplicación.';
        $rol_admin->save();

        $rol_coordinador = new Rol();
        $rol_coordinador->nombre='Coordinador';
        $rol_coordinador->descripcion='Se encarga de Cargar y Descargar los procesos contractuales.';
        $rol_coordinador->save();

        $rol_secretario = new Rol();
        $rol_secretario->nombre='Secretario';
        $rol_secretario->descripcion='Persona encargada de recibir procesos en el Área de Adquisiciones.';
        $rol_secretario->save();

        $rol_abogado = new Rol();
        $rol_abogado->nombre='Abogado';
        $rol_abogado->descripcion='Persona encargada de realizar el proceso jurídico de los procesos contractuales.';
        $rol_abogado->save();

        /**
         * ROLES
            GESTOR DE PUBLICACIÓN (PUBLICA DE TODOS LOS TIPOS)
            GESTOR DE DOCUMENTACIÓN Y ARCHIVO
            GESTOR DE AFILIACIÓN
            GESTOR DE NOTIFICACIÓN
            GESTOR DE CONTRATACIÓN
            *ABOGADO
            *SECRETARIO
            *COORDINADOR
            *ADMINISTRADOR
         */
    }
}
