<div id="listarEtapas">
    @foreach($etapas as $etapa)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title row">
                    <div class="col-md-4">
                        <a data-toggle="collapse" style="color: black" href="#collapse{{ $etapa->id }}">{{ $etapa->nombre }}-{{$etapa->indice}}</a>
                    </div>
                    <div class="col-md-2">
                        <form  class="FormSubir" id="FormSubir{{$etapa->id}}" method="post" action="/etapa/subir/{{$etapa->id}}">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                            <button type="submit" class="glyphicon glyphicon-triangle-top btn"></button>
                        </form>
                        <form  class="FormBajar" id="FormBajar{{$etapa->id}}" method="post" action="/etapa/bajar/{{$etapa->id}}">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                            <button type="submit"  class="glyphicon glyphicon-triangle-bottom btn"></button>
                        </form>
                    </div>
                    <!-- Boton Eliminar ETAPA-->
                    <div class="col-md-1 col-md-offset-5">
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

                    @include('etapa.indexrequisitos', compact($requisitos, $etapa))
                </div>
            </div>
        </div>
    @endforeach
</div>
