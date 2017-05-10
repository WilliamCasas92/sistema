<div class="panel panel-success">
    <div class="panel-heading text-center"><strong>¡{{\Auth::user()->nombre}}!</strong> Tienes los siguientes permisos:</div>
    <div class="panel-body">
        <ul class="list-group text-success">
            @if (\Auth::user()->hasRol('Administrador'))
                <li class="list-group-item">Administrador</li>
            @endif
            @if (\Auth::user()->hasRol('Coordinador'))
                <li class="list-group-item">Coordinador</li>
            @endif
            @if (\Auth::user()->hasRol('Secretario'))
                <li class="list-group-item">Secretario</li>
            @endif
            @if (\Auth::user()->hasRol('Abogado'))
                <li class="list-group-item">Abogado</li>
            @endif
            @if (\Auth::user()->hasRol('Gestor de contratación'))
                <li class="list-group-item">Gestor de contratación</li>
            @endif
            @if (\Auth::user()->hasRol('Gestor de notificación'))
                <li class="list-group-item">Gestor de notificación</li>
            @endif
            @if (\Auth::user()->hasRol('Gestor de afiliación'))
                <li class="list-group-item">Gestor de afiliación</li>
            @endif
            @if (\Auth::user()->hasRol('Gestor de archivo'))
                <li class="list-group-item">Gestor de archivo</li>
            @endif
            @if (\Auth::user()->hasRol('Gestor de publicación'))
                <li class="list-group-item">Gestor de publicación</li>
            @endif
            @if (\Auth::user()->hasRol('Secretario técnico de dependencia'))
                <li class="list-group-item">Secretario técnico de dependencia</li>
            @endif
            @if (\Auth::user()->hasRol('Usuario general'))
                <li class="list-group-item">Usuario general</li>
            @endif
        </ul>
    </div>
</div>
