<div id="listarRequisitos{{$etapa->id}}">
    @if($requisitos)
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Nombre Requisito</th>
                <th class="text-center">Tipo de Requisito</th>
                <th class="text-center">Obligatorio</th>
                <th class="text-center">Fecha de creación</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($requisitos as $requisito)
                @if($requisito->etapas_id==$etapa->id )
                    <tr>
                        <td class="text-center">{{ $requisito->nombre }}</td>
                        <td class="text-center">{{ $requisito->tipo_requisitos->nombre }}</td>
                        @if ($requisito->obligatorio==1)
                        <td class="text-center"><span class="glyphicon glyphicon-ok"></span></td>
                        @else
                        <td class="text-center"><span class="glyphicon glyphicon-remove"></span></td>
                        @endif
                        <td class="text-center">{{ $requisito->created_at }}</td>
                        <td class="text-center">
                            <!-- boton que permite llamar el modal para eliminar un requisito-->
                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modaldeleteRequisito" data-nombre="{{$requisito->nombre}}"
                                    data-listar="#listarRequisitos{{$etapa->id}}" data-url="{{ route('requisito.destroy', $requisito->id) }}" >Eliminar</button>
                        </td>
                    </tr>
                @endif
            </tbody>
            @endforeach
        </table>
    @endif
</div>