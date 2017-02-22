@extends('master')
@section('indexuser')
    @if (session('addUser'))
        <div class="alert alert-success">
            {{ session('addUser') }}
        </div>
    @endif
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Usuarios Registrados</h3></div>
            <div class="panel-body">
                <div align="left">
                    <h4><a class="btn btn-primary" href="{{route('users.create')}}">Crear nuevo usuario</a></h4>
                </div>
                <div class="table-responsive">
                    @if($users)
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
                        <button id="eliminar" type="submit" class="btn btn-danger btn-xs" >Eliminar</button>
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
