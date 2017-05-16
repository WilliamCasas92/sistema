@extends('master')
@section('createuser')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><label style="font-size : 20px;">Registrar Nuevo Usuario</label></div>
            <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="form-horizontal" method="post" action="/usuarios">
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
                                <label><input type="checkbox" id="rol_admin" name="rol_admin" value="1">Administrador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_coordinador" name="rol_coordinador" value="2">Coordinador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_secretario" name="rol_secretario" value="3">Secretario</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_abogado" name="rol_abogado" value="4">Abogado</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_gestorcontratacion" name="rol_gestorcontratacion" value="5">Gestor de Contratación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_gestornotificacion" name="rol_gestornotificacion" value="6">Gestor de Notificación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_gestorafiliacion" name="rol_gestorafiliacion" value="7">Gestor de Afiliación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_gestorarchivo" name="rol_gestorarchivo" value="8">Gestor de Archivo</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_gestorpublicacion" name="rol_gestorpublicacion" value="9">Gestor de Publicación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_secretariotecnico" name="rol_secretariotecnico" value="10">Secretario técnico de dependencia</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" id="rol_usuariogeneral" name="rol_usuariogeneral"  value="11">Usuario general</label>
                            </div>
                        </div>
                    </div><br>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" id="crear_usuario" class="btn btn-default">Crear usuario</button>
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
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
            document.getElementById('rol_coordinador').onchange = function() {
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
            document.getElementById('rol_secretario').onchange = function() {
                document.getElementById('rol_secretariotecnico').disabled = this.checked;
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
            document.getElementById('rol_abogado').onchange = function() {
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
            document.getElementById('rol_gestorcontratacion').onchange = function() {
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
            document.getElementById('rol_gestornotificacion').onchange = function() {
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
            document.getElementById('rol_gestorafiliacion').onchange = function() {
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
            document.getElementById('rol_gestorpublicacion').onchange = function() {
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
            document.getElementById('rol_secretariotecnico').onchange = function() {
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
            document.getElementById('rol_secretariotecnico').onchange = function() {
                document.getElementById('rol_secretario').disabled = this.checked;
                document.getElementById('rol_usuariogeneral').disabled = this.checked;
            };
        })
    </script>
@endsection