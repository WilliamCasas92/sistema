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
                            <div class="text-justify">
                                <h5><label>Tipo de proceso de contratacion:</label> {{ $proceso_contractual->tipo_proceso }}</h5>
                                <h5><label>Número de CDP:</label> {{ $proceso_contractual->numero_cdp }}</h5>
                                <h5><label>Objeto del contrato:</label> {{ $proceso_contractual->objeto }}</h5>
                                <h5><label>Dependencia correspondiente:</label> {{ $proceso_contractual->dependencia }}</h5>
                                @if ($proceso_contractual->numero_contrato!='')
                                    <h5><label>Número de contrato:</label> {{ $proceso_contractual->numero_contrato }}</h5>
                                @else
                                    <h5><label>Número de contrato:</label> Sin asignar.</h5>
                                @endif
                                <h5><label>Fecha de aprobación por comité:</label> {{ $proceso_contractual->fecha_aprobacion }}</h5>
                                @if ($proceso_contractual->nombre_supervisor!='')
                                <h5><label>Nombre del supervisor:</label> {{ $proceso_contractual->nombre_supervisor }}</h5>
                                @else
                                    <h5><label>Nombre del supervisor:</label> Sin asignar.</h5>
                                @endif
                                @if ($proceso_contractual->id_supervisor!='')
                                <h5><label>Identificación del supervisor:</label> {{ $proceso_contractual->id_supervisor }}</h5>
                                @else
                                    <h5><label>Identificación del supervisor:</label> Sin asignar.</h5>
                                @endif
                                @if ($proceso_contractual->email_supervisor!='')
                                <h5><label>Email del supervisor:</label> {{ $proceso_contractual->email_supervisor }}</h5>
                                @else
                                    <h5><label>Email del supervisor:</label> Sin asignar.</h5>
                                @endif
                                <h5><label>Estado del proceso:</label> {{ $proceso_contractual->estado }}</h5>
                                <h5><label>Fecha y Hora de ingreso en el sistema:</label> {{ $proceso_contractual->created_at }}</h5>
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