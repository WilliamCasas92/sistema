@extends('master')
@section('indicators')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3 align="center">Indicadores</h3></div>
            <div class="panel-body">
                <h4 align="center">Seleccióne una modalidad de contratación para ver más información.</h4><br>
                <ul class="well nav nav-pills nav-justified" style="background-color: white;">
                    @foreach($tipos_procesos as $tipo_proceso)
                        <li><a data-toggle="pill" href="#indicadorproceso{{$tipo_proceso->id}}">{{$tipo_proceso->nombre}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    <div id="home" class="well tab-pane fade in active" style="background-color: white;">
                        <h4 align="center">Aquí podrá ver la información de la modalidad de contratación seleccionada.</h4>
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
                                        <td>X</td>
                                    </tr>
                                    <tr>
                                        <td>Desiertos</td>
                                        <td>X</td>
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
                                        <td></td>
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
@endsection