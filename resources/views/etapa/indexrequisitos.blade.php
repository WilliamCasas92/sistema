<div id="listarRequisitos{{$etapa->id}}">
    @if($data1)
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
            @foreach($data1 as $row1)
                @if($row1->etapas_id==$etapa->id )
                    <tr>
                        <td class="text-center">{{ $row1->nombre }}</td>
                        <td class="text-center">{{ $row1->tipo_requisitos_id }}</td>
                        <td class="text-center">{{ $row1->id }}</td>
                        <td class="text-center">{{ $row1->created_at }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModaledit<?php echo $etapa->id ?>" disabled>Editar</button>
                            <!-- Modal Editar Requisito-->
                            @include('etapa.editrequisito', compact($row1, $etapa))
                            <form action="{{ route('requisito.destroy', $row1->id) }}" method="post">
                                <input name="_method" type="hidden" value="DELETE">
                                <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endif
            </tbody>
            @endforeach
        </table>
    @endif
</div>