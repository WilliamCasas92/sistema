@extends('master')
@section('indicators')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3 align="center">Registro de Actividad</h3></div>
            <div class="panel-body">
                <p>CDP: {{$proceso_contractual->numero_cdp}}</p>
                <p>Objeto: {{$proceso_contractual->objeto}}</p>

                <h1>Datos Etapas</h1>

                @foreach($historicos_datos_etapas as $historico_dato_etapa)
                    <p>{{$historico_dato_etapa->id}}</p>
                    <p>{{$historico_dato_etapa->valor}}</p>
                @endforeach
                <br>

                <h1>Procesos Etapas</h1>
                <table class="table">
                    <thea>
                    <tr>
                        <th class="text-center">Datos del Usuario</th>
                        <th class="text-center">Actividad</th>
                        <th class="text-center">Fecha de Activdad</th>
                    </tr>
                    </thea>
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
                                    <td>Proceso REANUDADO.<br>Proceso enviado a la etapa de: {{$proceso_contractual->estado}}.</td>
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