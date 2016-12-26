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
        //ADMINISTRADOR
        $rol_admin = new Rol();
        $rol_admin->nombre='Administrador';
        $rol_admin->descripcion='Administrador de la aplicación.';
        $rol_admin->save();
        //COORDINADOR
        $rol_coordinador = new Rol();
        $rol_coordinador->nombre='Coordinador';
        $rol_coordinador->descripcion='Se encarga de cargar y descargar los procesos contractuales en la base de datos de INFOCON.';
        $rol_coordinador->save();
        //SECRETARIO
        $rol_secretario = new Rol();
        $rol_secretario->nombre='Secretario';
        $rol_secretario->descripcion='Se encarga de recibir procesos contractuales en el Área de Adquisiciones.';
        $rol_secretario->save();
        //ABOGADO
        $rol_abogado = new Rol();
        $rol_abogado->nombre='Abogado';
        $rol_abogado->descripcion='Se encarga de realizar el proceso jurídico de los procesos contractuales.';
        $rol_abogado->save();
        //GESTOR DE CONTRATACIÓN
        $rol_gestorcontratacion = new Rol();
        $rol_gestorcontratacion->nombre='Gestor de contratación';
        $rol_gestorcontratacion->descripcion='Se encarga de solicitar el CRP y generar número de cotización.';
        $rol_gestorcontratacion->save();
        //GESTOR DE NOTIFICACIÓN
        $rol_gestornotificacion = new Rol();
        $rol_gestornotificacion->nombre='Gestor de notificación';
        $rol_gestornotificacion->descripcion='Se encarga de realizar las notificaciones de los contratos.';
        $rol_gestornotificacion->save();
        //GESTOR DE AFILIACIÓN
        $rol_gestorafiliacion = new Rol();
        $rol_gestorafiliacion->nombre='Gestor de afiliación';
        $rol_gestorafiliacion->descripcion='Se encarga de afiliar a las personas contratadas.';
        $rol_gestorafiliacion->save();
        //GESTOR DE ARCHIVO
        $rol_gestorarchivo = new Rol();
        $rol_gestorarchivo->nombre='Gestor de archivo';
        $rol_gestorarchivo->descripcion='Se encarga de archivar y expedir el acta de inicio.';
        $rol_gestorarchivo->save();
        //GESTOR DE PUBLICACIÓN
        $rol_gestorpublicacion = new Rol();
        $rol_gestorpublicacion->nombre='Gestor de publicación';
        $rol_gestorpublicacion->descripcion='Se encarga de publicar los procesos contractuales en los portales SECOP y Gestión Transparente.';
        $rol_gestorpublicacion->save();
    }
}