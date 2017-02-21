@php
    $existen_datos=false;
@endphp
@foreach ($requisitos as $requisito)
    @if ($requisito->etapas_id==$etapa->id)
        @php
            $existen_datos=true;
            $tipo_req=\App\Http\Controllers\DatosEtapaController::imprimir_tipo_requisitos($requisito->tipo_requisitos_id);
            $valor=\App\Http\Controllers\DatosEtapaController::busqueda_valor_dato_etapa($proceso_contractual->id, $requisito->id);
        @endphp
        @if( $tipo_req == 'checkbox')
                <label class="">{{$requisito->nombre}} :</label>
                @if ($valor==1)
                    Si
                @else
                    No
                @endif
                <br>
        @elseif ( $tipo_req == 'textarea' )
                <label class="">{{$requisito->nombre}}: </label>
                <div class="">
                    <textarea rows="6" class="form-control" readonly>{{$valor}}</textarea>
                </div>
                <br>
        @else
            <label class="">{{$requisito->nombre}} : </label>
            <div class="">
                <input type="{{$tipo_req}}" class="form-control" value="{{$valor}}" readonly>
            </div>
            <br>
        @endif
    @endif
@endforeach
@if ($existen_datos!=true)
    <h3>No hay información para esta etapa.</h3>
@endif