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
                            <span class="glyphicon glyphicon-search"></span>
                            <h4>Consulta Procesos de Contratación</h4>
                            <p>Visualiza la información detallada de un proceso contractual.</p>
                        </div>
                        <div class="col-sm-4">
                            <span class="glyphicon glyphicon-wrench"></span>
                            <h4 style="color:#303030;">Procesos Contractuales</h4>
                            <p>Crea, suspende, reanuda y diligencia información de un proceso de contratación.</p>
                        </div>
                        <div class="col-sm-4">
                            <span class="glyphicon glyphicon-lock"></span>
                            <h4>Gestión de Tipos de Proceso de Contratación</h4>
                            <p>Crea, suspende y edita las diferentes modalidades de contratación.</p>
                        </div>
                    </div>
                </div>
                <div class="container-fluid text-center">
                    <br><br>
                    <div class="row">
                        <div class="col-sm-4">
                            <span class="glyphicon glyphicon-stats"></span>
                            <h4>Indicadores</h4>
                            <p>Visualiza la cantidad de contratos y el tiempo que tardan en ser tramitados.</p>
                        </div>
                        <div class="col-sm-4">
                            <span class="glyphicon glyphicon-user"></span>
                            <h4>Gestión de Usuarios</h4>
                            <p>Agrega y asigna roles a los usuarios para que tengan acceso a SIGECOP.</p>
                        </div>
                        <div class="col-sm-4">
                            <span class="glyphicon glyphicon-th-list"></span>
                            <h4>Registro de Actividad</h4>
                            <p>Visualiza los cambios realizados entre etapas y datos de un proceso de contratación.</p>
                        </div>
                    </div>
                </div>
                <br><br><br>
            </div>
        </div>
    </div>
@endsection
