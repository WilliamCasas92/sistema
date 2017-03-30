@extends('master')
@section('createuser')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Registrar Nuevo Usuario</h3></div>
            <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="form-horizontal" method="post" action="/users">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombres:</label>
                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombres" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputApellidos">Apellidos:</label>
                        <div class="col-md-4">
                            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputEmail">Correo electronico institucional:</label>
                        <div class="col-md-4">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="@elpoli.edu.co" required>
                        </div>
                    </div>
                    @if(session()->has('msj'))
                        <div class="alert alert-danger" role="alert">{{ session('msj') }}</div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputRoles">Seleccione los Roles:</label><br>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_admin" value="1">Administrador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_coordinador" value="2">Coordinador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_secretario" value="3">Secretario</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_abogado" value="4">Abogado</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_gestorcontratacion" value="5">Gestor de Contratación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_gestornotificacion" value="6">Gestor de Notificación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_gestorafiliacion" value="7">Gestor de Afiliación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_gestorarchivo" value="8">Gestor de Archivo</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_gestorpublicacion" value="9">Gestor de Publicación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_secretariotecnico" value="10">Secretario técnico de dependencia</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="rol_usuariogeneral" value="11">Usuario general</label>
                            </div>
                        </div>
                    </div><br>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-default">Crear usuario</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('users.index')}}"><span class="glyphicon glyphicon-chevron-left"></span> Ir atrás</a></h4>
    </div>
@endsection