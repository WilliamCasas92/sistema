<div id="listarRequisitos{{$etapa->id}}">
    @if($requisitos)
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center">Nombre dato</th>
                <th class="text-center">Tipo de dato</th>
                <th class="text-center">ID</th>
                <th class="text-center">Fecha de creación</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($requisitos as $requisito)
                @if($requisito->etapas_id==$etapa->id )
                    <tr>
                        <td class="text-center">{{ $requisito->nombre }}</td>
                        <td class="text-center">{{ $requisito->tipo_requisitos_id }}</td>
                        <td class="text-center">{{ $requisito->id }}</td>
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