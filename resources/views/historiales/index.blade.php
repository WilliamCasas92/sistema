@extends('master')
@section('indicators')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3 align="center">Registros de Activad para el contrato con CDP: {{$proceso_contractual->numero_cdp}}</h3></div>
            <div class="panel-body">
                <h1>Datos Etapas</h1>

                @foreach($historicos_datos_etapas as $historico_dato_etapa)
                    <p>{{$historico_dato_etapa->id}}</p>
                    <p>{{$historico_dato_etapa->valor}}</p>
                @endforeach
                <br>

                <h1>Procesos Etapas</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Datos del Usuario</th>
                        <th>Actividad</th>
                        <th>Fecha de Activdad</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php(setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'))
                    @foreach($historicos_proceso_etapas as $historico_proceso_etapa)
                        @php($usuario=\App\Http\Controllers\HistorialController::buscar_usuario($historico_proceso_etapa->user_id))
                        @if($historico_proceso_etapa->estado=='Enviado al Área de Adquisiciones.')
                        <tr>
                            <td>Usuario: {{$usuario->nombre}} {{$usuario->apellidos}}<br>Email: {{$usuario->email}}</td>
                            <td>Ha enviado el proceso con CDP:{{$proceso_contractual->numero_cdp}} al Área de Adquisiciones.</td>
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