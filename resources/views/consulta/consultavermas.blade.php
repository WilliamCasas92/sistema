@extends('master')
@section('showcontractcontent')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <a data-toggle="collapse"  data-parent="#accordion" href="#collapseprocesocontractual">
                    <h4><label class="text-success">Datos generales del contrato</label></h4>
                </a>
            </div>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div id="collapseprocesocontractual" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <h5 class="text-primary" ><label>Información general del contrato</label></h5>
                                    <thead style="font-size : 11px;">
                                        <tr>
                                            <th class="text-center text-primary" width="35%"></th>
                                            <th class="text-center" width="50%"></th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size : 11px;">
                                        <tr>
                                            <td class="text-center" width="35%"><label>Tipo de proceso de contratacion:</label></td>
                                            <td width="35%">{{ $proceso_contractual->tipo_proceso }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="35%"><label>Número de CDP:</label></td>
                                            <td width="35%">{{ $proceso_contractual->numero_cdp }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="35%" ><label>Objeto del contrato:</label></td>
                                            <td class="text-justify" width="35%">{{ $proceso_contractual->objeto }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="35%"><label>Valor del contrato:</label></td>
                                            <td width="35%">${{number_format($proceso_contractual->valor)}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="35%"><label>Periodo de ejecución:</label></td>
                                            <td width="35%">{{ $proceso_contractual->plazo }} día(s)</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="35%"><label>Dependencia correspondiente:</label></td>
                                            <td width="35%">{{ $proceso_contractual->dependencia }}</td>
                                        </tr>
                                        @if ($proceso_contractual->numero_contrato!='0')
                                            <tr>
                                                <td class="text-center" width="35%"><label>Número de contrato:</label></td>
                                                <td width="35%">{{ $proceso_contractual->numero_contrato }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="text-center" width="35%"><label>Número de contrato:</label></td>
                                                <td width="35%">Sin asignar.</td>
                                            </tr>
                                        @endif
                                        @if ($proceso_contractual->nombre_supervisor!='')
                                            <tr>
                                                <td class="text-center" width="35%"><label>Nombre del supervisor:</label></td>
                                                <td width="35%">{{ $proceso_contractual->nombre_supervisor }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="text-center" width="35%"><label>Nombre del supervisor:</label></td>
                                                <td width="35%">Sin asignar.</td>
                                            </tr>
                                        @endif
                                        @if ($proceso_contractual->id_supervisor!='')
                                            <tr>
                                                <td class="text-center" width="35%"><label>Identificación del supervisor:</label></td>
                                                <td width="35%">{{ $proceso_contractual->id_supervisor }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="text-center" width="35%"><label>Identificación del supervisor:</label></td>
                                                <td width="35%">Sin asignar.</td>
                                            </tr>
                                        @endif
                                        @if ($proceso_contractual->email_supervisor!='')
                                            <tr>
                                                <td class="text-center" width="35%"><label>Email del supervisor:</label></td>
                                                <td width="35%">{{ $proceso_contractual->email_supervisor }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="text-center" width="35%"><label>Email del supervisor:</label></td>
                                                <td width="35%">Sin asignar.</td>
                                            </tr>
                                        @endif
                                        @if(Auth::user()->hasRol('Administrador'))
                                            <tr>
                                                <td class="text-center" width="35%"><label>Fecha y Hora de ingreso en el sistema:</label></td>
                                                <td width="35%">{{ $proceso_contractual->created_at }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="text-center" width="35%"><label>Comites participantes:</label></td>
                                            <td width="35%">
                                            @if ( ($proceso_contractual->comiteinterno)=='1' )
                                                Comité Interno de Docencia e Investigación <label>Fecha:</label> {{$proceso_contractual->fecha_comiteinterno}}</br>
                                            @elseif( ($proceso_contractual->comiteinterno)=='2' )
                                                Comité Interno de Extensión <label>Fecha:</label> {{$proceso_contractual->fecha_comiteinterno}}<br>
                                            @elseif( ($proceso_contractual->comiteinterno)=='3' )
                                                Comité Interno de Administración <label>Fecha:</label> {{$proceso_contractual->fecha_comiteinterno}}<br>
                                            @endif
                                            @if (($proceso_contractual->comiterectoria)=='4' )
                                                Comité Interno de Rectoría <label>Fecha:</label> {{$proceso_contractual->fecha_comiterectoria}}<br>
                                            @endif
                                            @if (($proceso_contractual->comiteasesor)=='5' )
                                                Comité Asesor de Contratación <label>Fecha:</label> {{$proceso_contractual->fecha_comiteasesor}}<br>
                                            @endif
                                            @if (($proceso_contractual->comiteevaluador)=='6' )
                                                Comité Evaluador <label>Fecha:</label> {{$proceso_contractual->fecha_comiteevaluador}}<br>
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="35%"><label>Estado del proceso:</label></td>
                                            <td width="35%">{{ $proceso_contractual->estado }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ACA SE IMPRIMEN LAS ETAPAS-->
            <div class="margincollapse">
                <div class="panel-group" id="accordion">
                    @include('consulta.veretapas', compact($proceso_contractual, $etapas, $requisitos))
                </div>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('consulta.mostrar')}}">Volver a la lista de consultas</a></h4>
    </div>
@endsection