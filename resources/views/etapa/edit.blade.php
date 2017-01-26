@extends('master')
@section('editetapa')
    <div class="container col-md-9">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Gestión de Etapas</h3></div>
            <div class="panel-body">
                <form id="formEtapa" class="form-horizontal" method="post" action="/etapa/{{$id}}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombre de la etapa:</label>
                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control" autocomplete="off" placeholder="Nombre de la Etapa" required>
                        </div>
                    </div>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-primary">Añadir Etapa</button>
                        </div>
                    </form>
                </form>
            </div>
            <!-- ACA ES DONDE SALEN LAS ETAPAS-->
            <div class="panel-group" id="accordion">
            <!--<div id="resultado">-->
                    @foreach($data as $etapa)
                        @include('etapa.index', compact($etapa, $data1))
                    @endforeach
            <!--</div>-->
            </div>

        </div>
        <h4><a class="btn btn-default" href="{{route('tipoproceso.index')}}">Volver a la lista de Tipos de Procesos</a></h4>
    </div>
@endsection



@section('Myscripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script language="javascript">
        /**
        $(document).ready(function() {
            $('#formEtapa').submit(function() {
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(data) {
                        ///$('#resultado').load(data);
                        //$('#resultado').append(data[]);
                    }
                })
                return false;
            });
        })*/
    </script>
@endsection