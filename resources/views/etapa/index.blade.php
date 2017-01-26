@foreach($data as $etapa)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse<?php echo $etapa->id ?>">{{ $etapa->nombre }}</a>
            </h4>
            <!-- Boton Eliminar ETAPA-->
            <form action="{{ route('etapa.destroy', $etapa->id) }}" method="post">
                <input name="_method" type="hidden" value="DELETE">
                <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
            </form>
        </div>
        <div id="collapse<?php echo $etapa->id ?>" class="panel-collapse collapse">
            <div class="panel-body">
                <!-- Modal Añadir Requisitos-->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $etapa->id ?>">Añadir Dato</button><br><br>
                <!-- Se llama la vista con el modal de Add Requisitos-->
                @include('etapa.modaladdrequisito', compact($etapa))
                <!-- Tabla de Indice de Requisitos-->
                <!-- Se llama la vista con la tabla de Requisitos-->
                @include('etapa.indexrequisitos', compact($data1, $etapa))
                <!-- Modal Añadir ROLES-->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalRol<?php echo $etapa->id ?>">Asignar Roles</button><br><br>
                <!-- Se llama la vista con el modal de Add Rol-->
                @include('etapa.modalrol', compact($etapa))
            </div>
        </div>
    </div>
@endforeach