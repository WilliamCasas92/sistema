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
                <label><input type="checkbox" name="administrador" value="">Administrador</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="coordinador" value="">Coordinador</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="secretario" value="">Secretario</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="abogado" value="">Abogado</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="gestorcontratacion" value="">Gestor de Contratación</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="gestornotificacion" value="">Gestor de Notificación</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="gestorafiliacion" value="">Gestor de Afiliación</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="gestorarchivo" value="">Gestor de Archivo</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="gestorpublicacion" value="">Gestor de Publicación</label>
            </div>
        </div>
        <button type="submit" class="btn btn-default">Crear</button>
    </form>
</div>