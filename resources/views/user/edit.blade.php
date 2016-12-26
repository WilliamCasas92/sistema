<div class="container">
    <h1>Crear usuario</h1>
    <h4><a href="{{route('users.index')}}">Ver Usuarios</a></h4>
    <hr>
    <form method="post" action="/users/{{$user->id}}">
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="InputName">Nombres</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombres" value="{{ $user->nombre }}">
        </div>
        <div class="form-group">
            <label for="InputApellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" value="{{ $user->apellidos }}">
        </div>
        <div class="form-group">
            <label for="InputEmail">Dirección Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="InputRoles">Roles</label>
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
                <label><input type="checkbox" name="rols[]" value="5" disabled>Gestor de Contratación</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rols[]" value="6" disabled>Gestor de Notificación</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rols[]" value="7" disabled>Gestor de Afiliación</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rols[]" value="8" disabled>Gestor de Archivo</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rols[]" value="9" disabled>Gestor de Publicación</label>
            </div>
        </div>

        <button type="submit" class="btn btn-default">Actualizar</button>
    </form>
</div>