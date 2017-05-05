@php
    $existen_datos=false;
@endphp
<div class="table-responsive">
    <table class="table table-condensed table-headborderless">
        <h5 class="text"><label>Información de Etapa</label></h5>
        <thead style="font-size : 11px;">
            <tr>
                <th class="text-justify text-info" width="35%"></th>
                <th class="text-justify" width="50%"></th>
            </tr>
        </thead>
        <tbody style="font-size : 11px;">
        @foreach ($requisitos as $requisito)
            @if ($requisito->etapas_id==$etapa->id)
                @php
                    $existen_datos=true;
                    $tipo_req=\App\Http\Controllers\DatosEtapaController::imprimir_tipo_requisitos($requisito->tipo_requisitos_id);
                    $valor=\App\Http\Controllers\DatosEtapaController::busqueda_valor_dato_etapa($proceso_contractual->id, $requisito->id);
                @endphp
                    <tr>
                        @if( $tipo_req == 'checkbox')
                            <td class="text-justify" width="35%"><label>{{$requisito->nombre}}</label></td>
                            @if ($valor==1)
                                <td width="35%">Si</td>
                            @else
                                <td width="35%">No</td>
                            @endif
                    </tr>
                    <tr>
                        @elseif ( $tipo_req == 'textarea' )
                            <td class="text-justify" width="35%"><label>{{$requisito->nombre}}</label></td>
                            <td class="text-justify" width="35%">{{$valor}}</td>
                    </tr>
                    <tr>
                        @elseif ( $tipo_req == 'file' )
                            @php
                                $tipo=\App\Http\Controllers\DatosEtapaController::busqueda_tipo_dato_etapa($proceso_contractual->id, $requisito->id);
                            @endphp
                            <td class="text-justify" width="35%"><label>{{$requisito->nombre}}</label></td>
                            <td class="text-justify" width="35%"><a href='/uploads/{{$valor}}-{{$requisito->id}}-{{$proceso_contractual->id}}.{{$tipo}}' download='{{$valor}}'>{{$valor}}</a></td>
                    </tr>
                    <tr>
                        @else
                            <td class="text-justify" width="35%"><label>{{$requisito->nombre}}</label></td>
                            <td width="35%">{{$valor}}</td>
                        @endif
                    </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
@if ($existen_datos!=true)
    <h3>No hay información para esta etapa.</h3>
@endif




