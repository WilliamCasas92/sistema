<div id="listarEtapas">
    @foreach($data as $etapa)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse"  href="#collapse<?php echo $etapa->id ?>">{{ $etapa->nombre }}</a>
                </h4>
                <!-- Boton Eliminar ETAPA-->
                <form id="formELiminarEtapa" action="{{ route('etapa.destroy', $etapa->id) }}" method="post" >
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                </form>
            </div>
            <div id="collapse<?php echo $etapa->id ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <!-- Boton que activa el modal Añadir Requisitos-->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRequisito"data-nombre="{{$etapa->nombre}}"
                            data-id="{{$etapa->id}}" data-listar="#listarRequisitos{{$etapa->id}}" data-url="/requisito/{{ $etapa->id }}">Añadir Requisito</button>
                    <!-- Modal Añadir ROLES-->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalRol<?php echo $etapa->id ?>">Asignar Roles</button>
                    <!-- Se llama la vista con el modal de Add Rol-->
                    @include('etapa.modalrol', compact($etapa))
                    <br><br>
                    <!-- Tabla de Indice de Requisitos-->
                    <!-- Se llama la vista con la tabla de Requisitos-->

                    @include('etapa.indexrequisitos', compact($data1, $etapa))
                </div>
            </div>
        </div>
    @endforeach
</div>
