@extends('master')
@section('indexuser')
    @if (session('addUser'))
        <div class="alert alert-success">
            {{ session('addUser') }}
        </div>
    @endif
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><h2>Usuarios Registrados</h2></div>
            <div class="panel-body">

                <!-- Seccion para la busqueda-->
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse"  data-parent="#accordion" href="#collapseconsulta">
                                <h4><label class="text-info">Filtrar búsqueda de usuarios <span class="glyphicon glyphicon-search"></span></label></h4>
                            </a>
                        </div>
                        <div id="collapseconsulta" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="well" name="FiltrosUsuario">
                                    <form class="form-horizontal" method="get" role="buscar" action="{{url('consultausuario')}}">
                                        <div class="form-group">
                                            <h6><label class="control-label col-md-2" for="nombre">Nombre: </label></h6>
                                            <div class="col-md-3">
                                                <input type="text" name="nombre" class="form-control" placeholder="Nombre del Usuario">
                                            </div>
                                            <h6><label class="control-label col-md-3" for="apellidos">Apellidos: </label></h6>
                                            <div class="col-md-3">
                                                <input type="text" name="apellidos" class="form-control" placeholder="Apellidos del Usuario">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h6><label class="control-label col-md-5" for="correo">Correo: </label></h6>
                                            <div class="col-md-3">
                                                <input type="text" name="correo" class="form-control" autocomplete="off" placeholder="Correo Institucional del Usuario">
                                            </div>
                                        </div>

                                        <form class="form-inline">
                                            <div align="center">
                                                <br><button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                                            </div>
                                        </form>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div align="center">
                    <h4><a class="btn btn-primary btn-sm" href="{{route('users.create')}}">Nuevo usuario</a></h4>
                </div><br>
                <div class="table-responsive">
                    @if($users!= null)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Nombres</th>
                                <th class="text-center">Apellidos</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Fecha de creación</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->nombre }}</td>
                                    <td class="text-center">{{ $user->apellidos }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-xs">Editar</a>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete" data-nombre="{{$user->nombre }}  {{$user->apellidos }} "
                                           data-url="{{ route('users.destroy', $user->id) }}">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    @else
                        <h3>No existen ninguna coincidencias con la busquedad.</h3>
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
                    ¿Desea eliminar usuario <b><span id="modalDeleteNombre"></span></b>?
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

@section('scriptUsers')
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
