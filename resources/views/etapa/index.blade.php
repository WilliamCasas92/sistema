<div id="listarEtapas">
    @foreach($etapas as $etapa)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title row">
                    <div class="col-md-4">
                        <a data-toggle="collapse" style="color: black" href="#collapse{{ $etapa->id }}">{{ $etapa->nombre }}</a>
                    </div>
                    <div class="col-md-1">
                        @if($etapa->indice > 1 )
                            <form  id="FormSubir{{$etapa->id}}" method="post" action="/etapa/subir/{{$etapa->id}}">
                                <input name="_method" type="hidden" value="PUT">
                                <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                                <button type="submit" class="glyphicon glyphicon-triangle-top btn" ></button>
                            </form>
                        @endif
                    </div>
                    <div class="col-md-1">
                        @if($etapa->indice < count($etapas))
                        <form  id="FormBajar{{$etapa->id}}" method="post" action="/etapa/bajar/{{$etapa->id}}">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                            <button type="submit"  class="glyphicon glyphicon-triangle-bottom btn"></button>
                        </form>
                        @endif
                    </div>
                    <!--Este sccript es el que permite que las etapas cambien de lugar sin recargarse la pagina-->
                    <script>
                        $(document).ready(function() {
                            $('#FormSubir{{$etapa->id}}, #FormBajar{{$etapa->id}}').submit(function () {
                            // Enviamos el formulario usando AJAX
                                $.ajax({
                                        type: 'POST',
                                    url: $(this).attr('action'),
                                    data: $(this).serialize(),
                                    // Mostramos un mensaje con la respuesta de PHP
                                        success: function (data) {
                                            $('#listarEtapas').html(data);
                                        }
                                });
                            return false;
                            });
                        });
                    </script>
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
