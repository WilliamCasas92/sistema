@extends('master')
@section('checkprocess')
    <div class="container col-md-9">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Proceso contractual para: {{$proceso_contractual->objeto}}</h3></div>
            <div class="panel-body">
            </div>
            <!-- ACA ES DONDE SALEN LAS ETAPAS-->
            <div class="panel-group" id="accordion">
                @include('datosetapas.showetapas', compact($proceso_contractual, $etapas, $requisitos))
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('procesocontractual.index')}}">Volver a la lista de Procesos Contractuales</a></h4>
    </div>
@endsection