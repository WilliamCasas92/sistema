@extends('master')
@section('checkprocess')
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
                                <h5><label>Tipo de proceso de contratacion: </label></h5>
                                    {{ $proceso_contractual->tipo_proceso }}
                                <h5><label>Número de CDP: </label></h5>
                                    {{ $proceso_contractual->numero_cdp }}
                                <h5><label>Objeto del contrato: </label></h5>
                                    {{ $proceso_contractual->objeto }}
                                <h5><label>Dependencia correspondiente: </label></h5>
                                    {{ $proceso_contractual->dependencia }}
                                <h5><label>Número de contrato: </label></h5>
                                    {{ $proceso_contractual->numero_contrato }}
                                <h5><label>Fecha de aprobación por comité: </label></h5>
                                    {{ $proceso_contractual->fecha_aprobacion }}
                                <h5><label>Nombre del supervisor: </label></h5>
                                    {{ $proceso_contractual->nombre_supervisor }}
                                <h5><label>Identificación del supervisor: </label></h5>
                                    {{ $proceso_contractual->id_supervisor }}
                                <h5><label>Email del supervisor: </label></h5>
                                    {{ $proceso_contractual->email_supervisor }}
                                <h5><label>Estado del proceso: </label></h5>
                                    {{ $proceso_contractual->estado }}
                                <h5><label>Fecha de ingreso en el sistema: </label></h5>
                                    {{ $proceso_contractual->created_at }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
           <!-- ACA ES DONDE SALEN LAS ETAPAS-->
            <div class="margincollapse">
                <div class="panel-group" id="accordion">
                    @include('datosetapas.showetapas', compact($proceso_contractual, $etapas, $requisitos))
                </div>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('procesocontractual.index')}}">Volver a la lista de Procesos Contractuales</a></h4>
    </div>
@endsection