@extends('master')
@section('indexuser')
    <div class="container">
        <h1>Crear usuario</h1>
        <h4><a href="{{route('users.index')}}">Ver Usuarios</a></h4>
        <hr>
        <form method="post" action="/users">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="InputName">Nombres</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombres">
            </div>
            <div class="form-group">
                <label for="InputApellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" placeholder="Apellidos">
            </div>
            <div class="form-group">
                <label for="InputEmail">Dirección Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="@elpoli.edu.co">
            </div>
            <div class="form-group">
                <label for="InputRoles">Roles</label>
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
            </div>
            <button type="submit" class="btn btn-default">Crear</button>
        </form>
    </div>
@endsection