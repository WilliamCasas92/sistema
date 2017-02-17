@extends('master')

@section('homecontent')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><h1>Servicios de la plataforma</h1></div>
            <div class="panel-body">
                <!-- Container (Services Section) -->
                <div class="container-fluid text-center">
                    <br><br>
                    <div class="row">
                        <div class="col-sm-4">
                            <span class="glyphicon glyphicon-lock"></span>
                            <h4>Gestión de Tipos de Proceso de Contratación</h4>
                            <p>Crea, suspende y edita los procesos de contratación.</p>
                        </div>
                        <div class="col-sm-4">
                            <span class="glyphicon glyphicon-user"></span>
                            <h4>Gestión de Usuarios</h4>
                            <p>Agrega y asigna permisos a los usuarios.</p>
                        </div>
                        <div class="col-sm-4">
                            <span class="glyphicon glyphicon-wrench"></span>
                            <h4 style="color:#303030;">Procesos Contractuales</h4>
                            <p>Crear y diligenciar informacion de un proceso de contratación.</p>
                        </div>
                    </div>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
@endsection
