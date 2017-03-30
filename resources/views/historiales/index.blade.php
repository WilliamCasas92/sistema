@extends('master')
@section('indicators')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3 align="center">Registro de Actividad</h3></div>
            <div class="panel-body">
                <p>CDP: {{$proceso_contractual->numero_cdp}}</p>
                <p>Objeto: {{$proceso_contractual->objeto}}</p>

                <h1>Datos Etapas</h1>
                <table class="table table-hover">
                    <thead>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Actividad</th>
                    <th class="text-center">Fecha de Activdad</th>
                    </thead>
                    <tbody class="text-center">
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
                                @endphp
                                <td>Agregó un nuevo dato en <label>{{$requisito->nombre}}</label><br>
                                    <label>{{$texto}}</label>.</td>
                            @else
                                @php
                                    if(!$dato_anterior->valor){
                                        $texto1='(Campo vacio)';
                                    }else{
                                        $texto1=$dato_anterior->valor;
                                    }
                                    if(!$historico_dato_etapa->valor){
                                        $texto2='(Campo vacio)';
                                    }else{
                                        $texto2=$historico_dato_etapa->valor;
                                    }
                                @endphp
                                <td>Cambió <label>{{$requisito->nombre}}</label><br>
                                    De {{$texto1}} a <label>{{$texto2}}</label>.</td>
                            @endif
                            <td>{{$historico_dato_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>

                <h1>Procesos Etapas</h1>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Actividad</th>
                        <th class="text-center">Fecha de Activdad</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($historicos_proceso_etapas as $historico_proceso_etapa)
                        @php($usuario=\App\Http\Controllers\HistorialController::buscar_usuario($historico_proceso_etapa->user_id))
                        @if($historico_proceso_etapa->estado=='Enviado al Área de Adquisiciones.')
                        <tr>
                            <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                            <td>Proceso enviado al Área de Adquisiciones.</td>
                            <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                        </tr>
                        @elseif($historico_proceso_etapa->estado=='Finalizado')
                            <tr>
                                <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                <td>Proceso FINALIZADO en el Área de Adquisiciones.</td>
                                <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                            </tr>
                            @elseif($historico_proceso_etapa->estado=='Desierto')
                                <tr>
                                    <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                    <td>Proceso declarado DESIERTO.</td>
                                    <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                </tr>
                            @elseif($historico_proceso_etapa->estado=='Reanudado')
                                <tr>
                                    <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                    <td>Proceso REANUDADO.<br>Proceso enviado a la primera etapa.</td>
                                    <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{$usuario->nombre}} {{$usuario->apellidos}}<br>{{$usuario->email}}</td>
                                    <td>Proceso enviado a la etapa de: {{$historico_proceso_etapa->estado}}.</td>
                                    <td>{{$historico_proceso_etapa->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection