@extends('master')
@section('edituser')

    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><label style="font-size : 20px;">Editar Usuario</label></div>
            <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="form-horizontal" method="post" action="/usuarios/{{$user->id}}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombres:</label>
                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombres" value="{{ $user->nombre }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputApellidos">Apellidos:</label>
                        <div class="col-md-4">
                            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" value="{{ $user->apellidos }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputEmail">Correo electronico institucional:</label>
                        <div class="col-md-4">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputRoles">Roles</label>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Administrador') ? 'checked':''}} name="rol_admin" value="1">Administrador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Coordinador') ? 'checked':''}} name="rol_coordinador" value="2">Coordinador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Secretario') ? 'checked':''}} name="rol_secretario" value="3">Secretario</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Abogado') ? 'checked':''}} name="rol_abogado" value="4">Abogado</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de contratación') ? 'checked':''}} name="rol_gestorcontratacion" value="5">Gestor de Contratación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de notificación') ? 'checked':''}} name="rol_gestornotificacion" value="6">Gestor de Notificación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de afiliación') ? 'checked':''}} name="rol_gestorafiliacion" value="7">Gestor de Afiliación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de archivo') ? 'checked':''}} name="rol_gestorarchivo" value="8">Gestor de Archivo</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de publicación') ? 'checked':''}} name="rol_gestorpublicacion" value="9">Gestor de Publicación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Secretario técnico de dependencia') ? 'checked':''}} name="rol_secretariotecnico" value="10">Secretario técnico de dependencia</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Usuario general') ? 'checked':''}} name="rol_usuariogeneral" value="11">Usuario general</label>
                            </div>
                        </div>
                    </div><br>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-default">Actualizar</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('usuarios.index')}}"><span class="glyphicon glyphicon-chevron-left"></span> Ir atrás</a></h4>
    </div>
@endsection

@section('scriptUsers')
    <script language="javascript">
        function ValidarCheck()
        {
            if(document.getElementById('rol_admin').checked && document.getElementById('rol_coordinador').checked
                && document.getElementById('rol_secretario').checked && document.getElementById('rol_abogado').checked
                && document.getElementById('rol_gestorcontratacion').checked && document.getElementById('rol_gestornotificacion').checked
                && document.getElementById('rol_gestorarchivo').checked && document.getElementById('rol_gestorpublicacion').checked
                && document.getElementById('rol_secretariotecnico').checked){
                return false;

            }
        };

        $(document).ready(function() {
            document.getElementById('rol_usuariogeneral').onchange = function() {
                document.getElementById('rol_admin').disabled = this.checked;
                document.getElementById('rol_coordinador').disabled = this.checked;
                document.getElementById('rol_secretario').disabled = this.checked;
                document.getElementById('rol_abogado').disabled = this.checked;
                document.getElementById('rol_gestorcontratacion').disabled = this.checked;
                document.getElementById('rol_gestornotificacion').disabled = this.checked;
                document.getElementById('rol_gestorafiliacion').disabled = this.checked;
                document.getElementById('rol_gestorarchivo').disabled = this.checked;
                document.getElementById('rol_gestorpublicacion').disabled = this.checked;
                document.getElementById('rol_secretariotecnico').disabled = this.checked;
            };
            document.getElementById('rol_admin').onchange = function() {
                valor=ValidarCheck();
                if(valor) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };
            document.getElementById('rol_coordinador').onchange = function() {
                valor=ValidarCheck();
                if(valor) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };
            document.getElementById('rol_secretario').onchange = function() {
                document.getElementById('rol_secretariotecnico').disabled = this.checked;
                valor=ValidarCheck();
                if(valor) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };
            document.getElementById('rol_abogado').onchange = function() {
                valor=ValidarCheck();
                if(valor) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };
            document.getElementById('rol_gestorcontratacion').onchange = function() {
                valor=ValidarCheck();
                if(valor) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };
            document.getElementById('rol_gestornotificacion').onchange = function() {
                valor=ValidarCheck();
                if(valor) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };
            document.getElementById('rol_gestorafiliacion').onchange = function() {
                valor=ValidarCheck();
                if(valor) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };
            document.getElementById('rol_gestorpublicacion').onchange = function() {
                if(ValidarCheck()) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };
            document.getElementById('rol_secretariotecnico').onchange = function() {
                valor=ValidarCheck();
                if(valor) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };
            document.getElementById('rol_secretariotecnico').onchange = function() {
                document.getElementById('rol_secretario').disabled = this.checked;
                if(ValidarCheck()) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };

        })
    </script>
@endsection