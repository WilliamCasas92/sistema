<div id="listarEtapas">
    @foreach($data as $etapa)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title row">
                    <div class="col-md-4">
                        <a data-toggle="collapse" style="color: black" href="#collapse{{ $etapa->id }}">{{ $etapa->nombre }}</a>
                    </div>
                    <!-- Boton Eliminar ETAPA-->
                    <div class="col-md-1 col-md-offset-7">
                        <button  type="button" class="btn btn-danger btn-xs " data-toggle="modal" data-target="#modalDelete" data-nombre="{{$etapa->nombre}}"
                          data-id="{{$etapa->id}}"  data-url="{{ route('etapa.destroy', $etapa->id) }}">Eliminar</button>
                    </div>
                </h4>
            </div>
            <div id="collapse<?php echo $etapa->id ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <!-- Boton que activa el modal Añadir Requisitos-->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRequisito" data-nombre="{{$etapa->nombre}}"
                            data-id="{{$etapa->id}}" data-listar="#listarRequisitos{{$etapa->id}}" data-url="/requisito/{{ $etapa->id }}">Añadir Requisito</button>

                    <!-- Modal Añadir ROLES-->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalRol<?php echo $etapa->id ?>">Asignar Roles</button>

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
