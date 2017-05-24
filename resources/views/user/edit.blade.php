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
                            @php
                                $disabled="";
                                $disabled2="";
                                $disabled3="";
                                $disabled4="";
                                if($user->hasRol("Administrador") || $user->hasRol('Coordinador') || $user->hasRol('Secretario') || $user->hasRol('Abogado') || $user->hasRol('Gestor de contratación') ||
                                    $user->hasRol('Gestor de notificación') || $user->hasRol('Gestor de afiliación') || $user->hasRol('Gestor de archivo') ||  $user->hasRol('Gestor de publicación') || $user->hasRol('Secretario técnico de dependencia')){
                                    $disabled="disabled";

                                    if($user->hasRol('Secretario')){
                                        $disabled2="disabled";
                                    }
                                    if($user->hasRol('Secretario técnico de dependencia')){
                                        $disabled3="disabled";
                                    }
                                }

                                if($user->hasRol('Usuario general')){
                                    $disabled4="disabled";
                                }
                            @endphp
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Administrador') ? 'checked':''}} name="rol_admin" id="rol_admin" value="1" {{$disabled4}}>Administrador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Coordinador') ? 'checked':''}} name="rol_coordinador" id="rol_coordinador" value="2" {{$disabled4}}>Coordinador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Secretario') ? 'checked':''}} name="rol_secretario" id="rol_secretario" value="3" {{$disabled3}} {{$disabled4}}>Secretario</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Abogado') ? 'checked':''}} name="rol_abogado" id="rol_abogado" value="4" {{$disabled4}}>Abogado</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de contratación') ? 'checked':''}} name="rol_gestorcontratacion" id="rol_gestorcontratacion" value="5" {{$disabled4}}>Gestor de Contratación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de notificación') ? 'checked':''}} name="rol_gestornotificacion" id="rol_gestornotificacion" value="6" {{$disabled4}}>Gestor de Notificación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de afiliación') ? 'checked':''}} name="rol_gestorafiliacion" id="rol_gestorafiliacion" value="7" {{$disabled4}}>Gestor de Afiliación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de archivo') ? 'checked':''}} name="rol_gestorarchivo" id="rol_gestorarchivo" value="8" {{$disabled4}}>Gestor de Archivo</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Gestor de publicación') ? 'checked':''}} name="rol_gestorpublicacion" id="rol_gestorpublicacion" value="9" {{$disabled4}}>Gestor de Publicación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Secretario técnico de dependencia') ? 'checked':''}} name="rol_secretariotecnico" id="rol_secretariotecnico" value="10" {{$disabled2}} {{$disabled4}}>Secretario técnico de dependencia</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $user->hasRol('Usuario general') ? 'checked':''}} name="rol_usuariogeneral" id="rol_usuariogeneral" value="11" {{$disabled}} >Usuario general</label>
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
                document.getElementById('rol_secretario').disabled = this.checked;
                if(ValidarCheck()) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }
            };

            document.getElementById('rol_gestorarchivo').onchange = function() {
                if(ValidarCheck()) {
                    document.getElementById('rol_usuariogeneral').disabled = this.checked;
                }

            };
            function ValidarCheck()
            {
                if(document.getElementById('rol_admin').checked==false && document.getElementById('rol_coordinador').checked==false && document.getElementById('rol_secretario').checked==false &&
                    document.getElementById('rol_abogado').checked==false && document.getElementById('rol_gestorcontratacion').checked==false && document.getElementById('rol_gestorafiliacion').checked==false
                    && document.getElementById('rol_gestorpublicacion').checked==false && document.getElementById('rol_secretariotecnico').checked==false && document.getElementById('rol_gestornotificacion').checked==false
                    && document.getElementById('rol_gestorarchivo').checked==false){
                    return true;
                }else {
                    if (document.getElementById('rol_usuariogeneral').disabled == false) {
                        return true;
                    }
                }
                return false;
            };
        })
    </script>
@endsection