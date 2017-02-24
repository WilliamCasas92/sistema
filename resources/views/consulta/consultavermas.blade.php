@extends('master')
@section('showcontractcontent')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h4>
                    <h4><label>Datos generales del contrato</label>
                        <br><a data-toggle="collapse"  data-parent="#accordion" href="#collapseprocesocontractual">
                            <span class="glyphicon glyphicon-chevron-down darkgreen"></span>
                        </a>
                    </h4>
                </h4></div>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div id="collapseprocesocontractual" class="panel-collapse collapse">
                        <div class="panel-body bodycollapsegeneral">
                            <div class="table-responsive">
                                <table class="bordetabla" style="background : lightgray;" >
                                    <tbody>
                                        <tr>
                                            <td class="text-center" width="35%"><label>Tipo de proceso de contratacion:</label></td>
                                            <td width="35%">{{ $proceso_contractual->tipo_proceso }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="35%"><label>Número de CDP:</label></td>
                                            <td width="50%">{{ $proceso_contractual->numero_cdp }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="35%" ><label>Objeto del contrato:</label></td>
                                            <td class="text-justify" width="35%">{{ $proceso_contractual->objeto }}</td>
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
                                        <tr>
                                            <td class="text-center" width="35%"><label>Fecha de reunión por comité:</label></td>
                                            <td width="35%">{{ $proceso_contractual->fecha_aprobacion }}</td>
                                        </tr>
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