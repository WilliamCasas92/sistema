@extends('master')
@section('indicators')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3>Registro de Actividad</h3>
            </div>
            <div class="panel-body">
                <div class="well well-sm" style="background-color: white;">
                    <!-- Tabla datos contrato-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">
                                <label class="text-info">Información General</label>
                            </h3>
                        </div>
                    </div>
                    <table class="table">
                        <thead style="font-size : 11px;">
                        <tr>
                            <th class="text-center" width="35%">Modalidad</th>
                            <th class="text-center">CPD</th>
                            <th class="text-center" width="35%">OBJETO</th>
                        </tr>
                        </thead>
                        <tbody style="font-size : 11px;">
                        <tr>
                            <td class="text-center">{{$proceso_contractual->tipo_proceso}}</td>
                            <td class="text-center">{{$proceso_contractual->numero_cdp}}</td>
                            <td class="text-justify" width="35%">{{$proceso_contractual->objeto}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#menu2">Actividad en las Etapas</a></li>
                    <li><a data-toggle="tab" href="#menu1">Actividad en los datos</a></li>
                </ul>
                <div class="tab-content">
                    <div id="menu2" class="well tab-pane fade in active" style="background-color: white;">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <label class="text-info">Cambios realizados</label>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion">
                            <!-- Tabla cambios de etapas-->
                            @if($historicos_proceso_etapas)
                                <table class="table table-hover">
                                    <thead style="font-size : 11px;">
                                    <tr>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Actividad</th>
                                        <th class="text-center">Fecha de Activdad</th>
                                    </tr>
                                    </thead>
                                    <tbody style="font-size : 11px;" class="text-center">
                                    @foreach($historicos_proceso_etapas as $historico_proceso_etapa)
                                        @php($usuario=\App\Http\Controllers\HistorialController::buscar_usuario($historico_proceso_etapa->user_id))
                                        @if($historico_proceso_etapa->estado=='Enviado al Área de Adquisiciones.')
                                            <tr>
                                                <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                                <td>Proceso <label>ENVIADO al Área de Adquisiciones</label>.</td>
                                                <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                            </tr>
                                        @elseif($historico_proceso_etapa->estado=='Finalizado')
                                            <tr>
                                                <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                                <td>Proceso <label>FINALIZADO</label> en el Área de Adquisiciones.</td>
                                                <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                            </tr>
                                        @elseif($historico_proceso_etapa->estado=='Desierto')
                                            <tr>
                                                <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                                <td>Proceso declarado <label>DESIERTO</label>.</td>
                                                <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                            </tr>
                                        @elseif($historico_proceso_etapa->estado=='Reanudado')
                                            <tr>
                                                <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                                <td>Proceso <label>REANUDADO</label>.<br>Proceso enviado a la primera etapa.</td>
                                                <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                                <td>Proceso enviado a la etapa de: <label>{{$historico_proceso_etapa->estado}}</label>.</td>
                                                <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            @elseif(isEmpty($historicos_proceso_etapas))
                                <div class="panel panel-info">
                                    <h5 align="center">No existen cambios realizados.</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div id="menu1" class="well tab-pane fade " style="background-color: white;">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <label class="text-info">Cambios realizados</label>
                                </h4>
                            </div>
                        </div>
                        <div class="panel-group" id="accordion">
                            <!-- Tabla cambios de datos-->
                            @if(count($historicos_datos_etapas))
                                <table class="table table-hover">
                                    <thead style="font-size : 11px;">
                                        <tr>
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Actividad</th>
                                            <th class="text-center">Etapa</th>
                                            <th class="text-center">Fecha de Activdad</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size : 11px;" class="text-center">
                                @foreach($historicos_datos_etapas as $historico_dato_etapa)
                                    @php($usuario=\App\Http\Controllers\HistorialController::buscar_usuario($historico_dato_etapa->user_id))
                                    @php($requisito=\App\Http\Controllers\HistorialController::buscar_requisito($historico_dato_etapa->requisitos_id))
                                    <tr>
                                        <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                        @php($dato_anterior=\App\Http\Controllers\HistorialController::buscar_dato_anterior($historico_dato_etapa->requisitos_id, $historico_dato_etapa->proceso_contractual_id, $historico_dato_etapa->id))
                                        @if($dato_anterior==false)
                                            @php
                                                if(!$historico_dato_etapa->valor){
                                                    $texto='(Campo vacio)';
                                                }else{
                                                    $texto=$historico_dato_etapa->valor;
                                                }
                                                if($requisito->tipo_requisitos->tipo=='checkbox'){
                                                    if($historico_dato_etapa->valor=='1'){
                                                        $texto='Si';
                                                    }else{
                                                        $texto='No';
                                                    }
                                                }
                                            @endphp
                                            <td>Agregó en el campo <label>"{{$requisito->nombre}}"</label><br>
                                                El siguiente dato: <label>{{$texto}}</label>.</td>
                                        @else
                                            @php
                                                if(!$historico_dato_etapa->valor){
                                                    $texto='(Campo vacio)';
                                                }else{
                                                    $texto=$historico_dato_etapa->valor;
                                                }
                                                if($requisito->tipo_requisitos->tipo=='checkbox'){
                                                    if($historico_dato_etapa->valor=='1'){
                                                        $texto='Si';
                                                    }else{
                                                        $texto='No';
                                                    }
                                                }
                                            @endphp
                                            <td>Actualizó en el campo <label>"{{$requisito->nombre}}"</label><br>
                                                El siguiente dato: <label>{{$texto}}</label>.</td>
                                        @endif
                                        <td>{{$requisito->etapas->nombre}}</td>
                                        <td>{{$historico_dato_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                </table>
                            @elseif(!count($historicos_datos_etapas))
                                <div class="panel panel-info">
                                    <h5 align="center">No existen cambios realizados.</h5>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <h4><a class="btn btn-default" href="{{route('consulta.mostrar')}}"><span class="glyphicon glyphicon-chevron-left"></span> Ir atrás</a></h4>
            </div>
        </div>
    </div>
@endsection