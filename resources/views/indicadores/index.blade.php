@extends('master')
@section('indicators')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h2 align="center">Indicadores</h2></div>
            <div class="panel-body">
                <!-- Container (Services Section) -->
                <div class="well well-sm container-fluid text-center alert alert-info">
                    <br><br>
                    <div class="row">
                        <div class="col-sm-3">
                            <h1><span class="glyphicon glyphicon-globe"></span></h1>
                            @php($cantidad_total=\App\Http\Controllers\IndicadoresController::cantidad_procesos_totales())
                            <h2>{{$cantidad_total}}</h2>
                            <h5><label>Procesos almacenados en el sistema.</label></h5>
                        </div>
                        <div class="col-sm-3 ">
                            <h1><span class="glyphicon glyphicon-flag "></span></h1>
                            <h2>x</h2>
                            <h5><label>Procesos en el Área de Adquisiciones.</label></h5>
                        </div>
                        <div class="col-sm-3 ">
                            <h1><span class="glyphicon glyphicon-ok "></span></h1>
                            @php($cantidad_total_finalizados=\App\Http\Controllers\IndicadoresController::cantidad_procesos_totales_finalizados())
                            <h2>{{$cantidad_total_finalizados}}</h2>
                            <h5><label>Procesos finalizados en el Área de Adquisiciones.</label></h5>
                        </div>
                        <div class="col-sm-3 ">
                            <h1><span class="glyphicon glyphicon-fire "></span></h1>
                            @php($cantidad_total_desiertos=\App\Http\Controllers\IndicadoresController::cantidad_procesos_totales_desiertos())
                            <h2>{{$cantidad_total_finalizados}}</h2>
                            <h5><label>Procesos declarados desiertos.</label></h5>
                        </div>
                    </div>
                </div><br>
                <div class="well">
                <h5 class="darkblue" align="center">Seleccióne una modalidad de contratación para ver más información.</h5><br>
                <ul class="well nav nav-pills nav-justified" style="background-color: white;">
                    @foreach($tipos_procesos as $tipo_proceso)
                        <li><a data-toggle="pill" href="#indicadorproceso{{$tipo_proceso->id}}">{{$tipo_proceso->nombre}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active" style="background-color: white;">
                        <h5 align="center">Aquí podrá ver la información de la modalidad de contratación seleccionada.</h5>
                    </div>
                    @foreach($tipos_procesos as $tipo_proceso)
                        <div id="indicadorproceso{{$tipo_proceso->id}}" class="well tab-pane fade" style="background-color: white;">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                        <h4 class="panel-title text-center">
                                            <label class="text-info">{{$tipo_proceso->nombre}}</label>
                                        </h4>
                                </div>
                                <!-- Tabla -->
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Inidicadores</th>
                                        <th class="text-center">Número de Procesos</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    <tr>
                                        <td>Almacenados en el sistema</td>
                                        @php($cantidad=\App\Http\Controllers\IndicadoresController::cantidad_procesos($tipo_proceso->nombre))
                                        <td>{{$cantidad}}</td>
                                    </tr>
                                    <tr>
                                        <td>Sin enviar al Área de Adquisiciones</td>
                                        @php($cantidad_sin_enviar=\App\Http\Controllers\IndicadoresController::cantidad_procesos_sin_enviar($tipo_proceso->nombre))
                                        <td>{{$cantidad_sin_enviar}}</td>
                                    </tr>
                                    <tr>
                                        <td>Esperando recepción en el Área de Adquisiciones</td>
                                        @php($cantidad_enviados=\App\Http\Controllers\IndicadoresController::cantidad_procesos_enviados($tipo_proceso->nombre))
                                        <td>{{$cantidad_enviados}}</td>
                                    </tr>
                                    <tr>
                                        <td>En Trámite dentro del Área de Adquisiciones</td>
                                        @php
                                            $procesos_adqui=0;
                                            $etapas=\App\Http\Controllers\IndicadoresController::etapas_tipo_proceso($tipo_proceso->id);
                                            foreach($etapas as $etapa){
                                                $cantidad_proceso_etapa=\App\Http\Controllers\IndicadoresController::cantidad_procesos_etapa($tipo_proceso->nombre, $etapa->nombre);
                                                $procesos_adqui=$procesos_adqui+$cantidad_proceso_etapa;
                                            }
                                        @endphp
                                        <td>{{$procesos_adqui}}</td>
                                    </tr>
                                    <tr>
                                        <td>Finalizados</td>
                                        @php($cantidad_finalizados=\App\Http\Controllers\IndicadoresController::cantidad_procesos_finalizados($tipo_proceso->nombre))
                                        <td>{{$cantidad_finalizados}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desiertos</td>
                                        @php($cantidad_desiertos=\App\Http\Controllers\IndicadoresController::cantidad_procesos_desiertos($tipo_proceso->nombre))
                                        <td>{{$cantidad_desiertos}}</td>
                                    </tr>
                                    </tbody>
                                    <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Tiempo Promedio</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    <tr>
                                        <td>De comité al Área de Adquisiciones</td>
                                        @php($tiempo_promedio_llegada=\App\Http\Controllers\IndicadoresController::tiempo_promedio_llegada($tipo_proceso->nombre, $tipo_proceso->id))
                                        <td>{{$tiempo_promedio_llegada}}</td>
                                    </tr>
                                    <tr>
                                        <td>Dentro del Área de Adquisiciones</td>
                                        @php($tiempo_promedio_adquisiciones=\App\Http\Controllers\IndicadoresController::tiempo_promedio_adquisiciones($tipo_proceso->nombre, $tipo_proceso->id))
                                        <td>{{$tiempo_promedio_adquisiciones}} horas</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-group" id="accordion">
                                @include('indicadores.indexetapas', compact($etapas, $tipo_proceso))
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>

            </div>
        </div>
    </div>
@endsection