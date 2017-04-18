<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-condensed table-headborderless">
            @if($observaciones->count())
                <tr>
                    <th>Fecha</th>
                    <th>Observación</th>
                    <th>Usuario</th>
                </tr>
                @foreach($observaciones as $observacion)
                    <tr>
                        <td width="">{{$observacion->created_at}}</td>
                        <td width="">{{$observacion->observacion}}</td>
                        @php
                        $usuario=\App\Http\Controllers\ObservacionesController::busqueda_usuario($observacion->user_id);
                        @endphp
                        <td width="">{{$usuario}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-xs center-block" data-toggle="modal" data-target="#modaleditObservacion"
                            data-idproceso="{{$proceso_contractual->id}}" data-observacion="{{$observacion->observacion}}" data-url="{{ route('observacion.update',array($observacion->id))}}">Editar</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-xs center-block" data-toggle="modal" data-target="#modaldeleteObservacion"
                                    data-idproceso="{{$proceso_contractual->id}}" data-observacion="{{$observacion->observacion}}" data-url="{{ route('observacion.destroy',array($observacion->id))}}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <h4>En este momento no hay observaciones para mostrar</h4>
                </tr>
            @endif
        </table>
        <button type="button" class="btn btn-success btn-xs center-block" data-toggle="modal" data-target="#modaladdObservacion"
        data-idproceso="{{$proceso_contractual->id}}">Añadir Observación</button>
        @include('datosetapas.modaladdobservaciones')
        @include('datosetapas.modaleditobservaciones')
        @include('datosetapas.modaldeleteobservaciones')
    </div>
</div>