@extends('master')
@section('homecontent')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><label style="font-size : 25px;">Bienvenido(a) a SIGECOP</label></div>
            <div class="panel-body">
                <div class="container-fluid text-center">
                    <div class="row">
                        <div class="col-md-7">

                            <div class="alert alert-success">
                                <strong>¡{{\Auth::user()->nombre}}!</strong> Tienes los siguientes permisos.
                            </div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <tbody>
                                    @if (\Auth::user()->hasRol('Administrador'))
                                        <tr>
                                            <td class="" width="40%"><h5 class="text-success"><strong>Administrador</strong></h5></td>
                                            <td class="text-left">En la opción de
                                                <span class="label label-success"><span class="glyphicon glyphicon-wrench"></span> Administración</span> puedes:<br>
                                                <a href="{{ url('usuarios') }}">
                                                    <span class="glyphicon glyphicon-user"></span>Gestionar Usuarios</a> otorgando permisos y acceso a SIGECOP.<br>
                                                <a href="{{ url('tipoproceso') }}">
                                                    <span class="glyphicon glyphicon-lock"></span>Gestionar Tipos de Proceso de Contratación</a> donde puede crear las diferentes modalidades con sus etapas y requisitos<br>
                                                <a href="{{ url('indicadores') }}">
                                                    <span class="glyphicon glyphicon-stats"></span>Ver Indicadores</a> de los procesos que se encuentren registrados en SIGECOP.
                                            </td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Coordinador'))
                                        <tr class="success">
                                            <td>Coordinador</td>
                                            <td>Tiene acceso a la opción de
                                                <span class="label label-success"><span class="glyphicon glyphicon-wrench"></span> Administración</span>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Secretario'))
                                        <tr class="success">
                                            <td>Coordinador</td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Abogado'))
                                        <tr>
                                            <td>Abogado</td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Gestor de contratación'))
                                        <tr>
                                            <td>Gestor de contratación</td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Gestor de notificación'))
                                        <tr>
                                            <td>Gestor de notificación</td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Gestor de afiliación'))
                                        <tr>
                                            <td class=""><h5 class="text-success"><strong>Gestor de afiliación</strong></h5></td>
                                            <td class="text-left">En la opción de
                                                <span class="label label-success"><span class="glyphicon glyphicon-search"></span> Procesos Contractuales</span> puede:<br>

                                            </td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Gestor de archivo'))
                                        <tr>
                                            <td class=""><h5 class="text-success"><strong>Gestor de archivo</strong></h5></td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Gestor de publicación'))
                                        <tr>
                                            <td>Gestor de publicación</td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Secretario técnico de dependencia'))
                                        <tr>
                                            <td>Secretario técnico de dependencia</td>
                                        </tr>
                                    @endif
                                    @if (\Auth::user()->hasRol('Usuario general'))
                                        <tr>
                                            <td>Usuario general</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="alert alert-success">
                                <strong>¡Procesos por atender!</strong>
                            </div>
                            @php($procesos_contractuales=\App\Http\Controllers\ProcesoContractualController::procesos_contractuales())
                            @foreach ($procesos_contractuales as $proceso_contractual)
                                @php($etapa_usuario=\App\Http\Controllers\ProcesoContractualController::etapa_usuario($proceso_contractual->estado, $proceso_contractual->tipo_procesos_id))
                                @if(($etapa_usuario==true) && ($proceso_contractual->estado!='Finalizado'))
                                    <div class="alert alert-success text-justify">
                                        <strong>Proceso con CDP:</strong> {{$proceso_contractual->numero_cdp}}.<br>
                                        <strong>Objeto:</strong> {{$proceso_contractual->objeto}}. <br>
                                        <a href="{{ route('datosetapas.menu', $proceso_contractual->id) }}" class="btn btn-success btn-sm">¡Diligenciar ahora!</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
