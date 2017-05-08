@extends('master')
@section('indexprocesstype')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><label style="font-size : 25px;">Tipos de Procesos Registrados</label></div>
            <div class="panel-body">
                <div align="center">
                    <h4><a class="btn btn-primary btn-sm" href="{{route('tipoproceso.create')}}">Nuevo tipo de proceso de contratación</a></h4>
                </div><br>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="table-responsive">
                    @if($tipos_procesos)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Versión</th>
                                <th class="text-center">Activo</th>
                                <th class="text-center">Fecha de creación</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tipos_procesos as $tipo_proceso)
                                <tr>
                                    <td class="text-center">{{ $tipo_proceso->nombre }}</td>
                                    <td class="text-center">{{ $tipo_proceso->version }}</td>
                                    @if ($tipo_proceso->activo==1)
                                        <td class="text-center"><span class="glyphicon glyphicon-ok"></span></td>
                                        @else
                                        <td class="text-center"><span class="glyphicon glyphicon-ban-circle"></span></td>
                                    @endif
                                    <td class="text-center">{{ $tipo_proceso->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('etapa.almacenar', $tipo_proceso, 'tipo_proceso') }}" class="btn btn-success btn-xs">Gestionar Etapas</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('tipoproceso.edit', $tipo_proceso->id) }}" class="btn btn-info btn-xs">Editar</a>
                                        <a type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete" data-nombre=" {{$tipo_proceso->nombre}}  "
                                                data-url="{{ route('tipoproceso.destroy', $tipo_proceso->id) }}">Eliminar</a><br>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitulo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalDeleteTitulo">Confirmar eliminación</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Confirma que desea eliminar <b><span id="modalDeleteNombre"></span></b>?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <span class="pull-right">
                    <form id="modalDeleteForm"  method="post">
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                        <button id="eliminar" type="submit" class="btn btn-danger" >Eliminar</button>
                    </form>
                </span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptTipoProceso')
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<script src="/js/jquery-3.1.1.js" language="javascript"></script>-->
    <script language="javascript">
        $(document).ready(function() {
            $(function() {
                $('#modalDelete').on("show.bs.modal", function (e) {
                    $("#modalDeleteNombre").html($(e.relatedTarget).data('nombre'));
                    $("#modalDeleteForm").attr('action', $(e.relatedTarget).data('url'));
                });
            });
        });
    </script>
@endsection
