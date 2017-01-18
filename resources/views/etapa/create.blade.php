@extends('master')
@section('createetapa')
    <div class="container col-md-9">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Gestión de Etapas</h3></div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="/etapa">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombre de la etapa:</label>
                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre de la Etapa">
                        </div>
                    </div>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-default">Añadir Etapa</button>
                        </div>
                    </form>
                </form>
             @each('etapa.index', $data, 'data')
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('tipoproceso.index')}}">Volver a la lista de Tipos de Procesos</a></h4>
    </div>
@endsection



@section('Myscripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
