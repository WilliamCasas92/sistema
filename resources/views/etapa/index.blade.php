<div id="listarEtapas">
    @foreach($etapas as $etapa)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title row">
                    <div class="col-md-4">
                        <a data-toggle="collapse" style="color: black" href="#collapse{{ $etapa->id }}" title="Click aquí para Abrir Etapa">
                            <label class="text-success">{{ $etapa->nombre }}</label>
                        </a>
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
                    <script>
                        $(document).ready(function() {
                            // Interceptamos el evento submit del formulario agregar Etapa, Al fomulario eliminar Etapa
                            $('#FormSubir{{$etapa->id}}, #FormBajar{{$etapa->id}}').submit(function () {
                            // Enviamos el formulario usando AJAX
                                $.ajax({
                                        type: 'PUT',
                                        url: $(this).attr('action'),
                                        data: $(this).serialize(),
                                    // Mostramos un mensaje con la respuesta de PHP
                                        success: function (data) {
                                        $('#listarEtapas').html(data);
                                    }
                                    }).fail(function (jqXHR, textStatus, errorThrown) {
                                    alert('La etapa no se puede eliminar porque tiene requisitos asociados');
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
                    <script>
                        //En este script estamos enviando el contenido del formulario Rol por medio de ajax
                        $(document).ready(function() {
                            // Interceptamos el evento submit del formulario agregar Rol, Al fomulario eliminar Etapa
                            $('#formRol{{$etapa->id}}').submit(function () {
                                // Enviamos el formulario usando AJAX
                                $.ajax({
                                    type: 'POST',
                                    url: $(this).attr('action'),
                                    data: $(this).serialize(),
                                    // Mostramos un mensaje con la respuesta de PHP
                                    success: function (data) {
                                        $('#myModalRol{{$etapa->id}}').modal('hide');
                                    }
                                });
                                return false;
                            });
                        });
                    </script>
                    <!-- Tabla de Indice de Requisitos-->
                    <!-- Se llama la vista con la tabla de Requisitos-->

                    @include('etapa.indexrequisitos', compact($requisitos, $etapa))
                </div>
            </div>
        </div>
    @endforeach
</div>
