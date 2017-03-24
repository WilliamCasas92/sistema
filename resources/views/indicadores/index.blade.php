@extends('master')
@section('indicators')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3 align="center">Indicadores</h3></div>
            <div class="panel-body">
                <p>Seleccióne un tipo de proceso para ver más información.</p><br>
                <ul class="nav nav-pills nav-justified">
                    @foreach($tipos_procesos as $tipo_proceso)
                        <li><a data-toggle="pill" href="#indicadorproceso{{$tipo_proceso->id}}">{{$tipo_proceso->nombre}}</a></li>
                    @endforeach
                </ul><br>
                <div class="tab-content">
                    @foreach($tipos_procesos as $tipo_proceso)
                        <div id="indicadorproceso{{$tipo_proceso->id}}" class="well tab-pane fade">
                            @php($cantidad=\App\Http\Controllers\IndicadoresController::cantidad_procesos($tipo_proceso->nombre))
                            <h3 class="text-info">{{$tipo_proceso->nombre}}</h3>
                            <p>Cantidad de procesos almacenados en el sistema: {{$cantidad}}</p>
                            @php($cantidad_sin_enviar=\App\Http\Controllers\IndicadoresController::cantidad_procesos_sin_enviar($tipo_proceso->nombre))
                            <p>Cantidad de procesos sin enviar al Área de Adquisiciones: {{$cantidad_sin_enviar}}</p>
                            @php($cantidad_enviados=\App\Http\Controllers\IndicadoresController::cantidad_procesos_enviados($tipo_proceso->nombre))
                            <p>Cantidad de procesos esperando ser recibidos en el Área de Adquisiciones: {{$cantidad_enviados}}</p>
                            @php
                                $procesos_adqui=0;
                                $etapas=\App\Http\Controllers\IndicadoresController::etapas_tipo_proceso($tipo_proceso->id);
                                foreach($etapas as $etapa){
                                    $cantidad_proceso_etapa=\App\Http\Controllers\IndicadoresController::cantidad_procesos_etapa($tipo_proceso->nombre, $etapa->nombre);
                                    $procesos_adqui=$procesos_adqui+$cantidad_proceso_etapa;
                                }
                            @endphp
                            <p>Cantidad de procesos en trámite en el Área de Adquisiciones: {{$procesos_adqui}}</p>

                            <p>Cantidad de procesos finalizados en el Área de Adquisiciones: X</p>

                            <p>Cantidad de procesos desiertos en el Área de Adquisiciones: X</p>
                            @php($tiempo_promedio_llegada=\App\Http\Controllers\IndicadoresController::tiempo_promedio_llegada($tipo_proceso->nombre, $tipo_proceso->id))
                            <p>Tiempo promedio en llegar al Área de Adquisiciones: {{$tiempo_promedio_llegada}}</p>

                            <p>Tiempo promedio en el Área de Adquisiciones: X</p>
                            <br>
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