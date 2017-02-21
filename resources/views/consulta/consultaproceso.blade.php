@extends('master')
@section('consultacontent')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><h1>Consulta de proceso de contratación</h1></div>
            <div class="panel-body">
                <div name="FiltrosDeBusqueda">

                </div>
                <div name="ResultadosDeBusqueda">
                    <div class="table-responsive">
                        @if($procesos_contractuales->count())
                            <table class="table table-hover">
                                <thead style="font-size : 11px;">
                                <tr>
                                    <th class="text-center">CDP</th>
                                    <th class="text-center" width="35%">Objeto</th>
                                    <th class="text-center">Dependencia</th>
                                    <th class="text-center">Tipo de Proceso</th>
                                    <th class="text-center">Fecha de Aprobación por comité</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <tbody style="font-size : 11px;">
                                @foreach($procesos_contractuales as $proceso_contractual)
                                    <tr>
                                        <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->numero_cdp }}</td>
                                        <td style="font-size : 11px;" class="text-justify" width="35%">{{ $proceso_contractual->objeto }}</td>
                                        <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->dependencia }}</td>
                                        <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->tipo_proceso }}</td>
                                        <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->fecha_aprobacion }}</td>
                                        <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->estado }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('consulta.consultavermas', $proceso_contractual->id) }}" class="btn btn-info btn-xs">Ver mas</a><br>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        @else
                            <h4 class="well" align="center">No existen procesos por consultar.</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection