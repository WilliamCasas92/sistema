
    <div class="table-responsive" id="showObservaciones">
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
                                data-idproceso="{{$proceso_contractual->id}}" data-observacion="{{$observacion->observacion}}"
                                data-url="{{ route('observacion.update',array($observacion->id))}}">Editar</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-xs center-block" data-toggle="modal" data-target="#modaldeleteObservacion"
                                data-idproceso="{{$proceso_contractual->id}}" data-observacion="{{$observacion->observacion}}"
                                data-url="{{ route('observacion.destroy',array($observacion->id))}}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <h5>No hay observaciones para mostrar.</h5>
                </tr>
            @endif
        </table>
    </div>
