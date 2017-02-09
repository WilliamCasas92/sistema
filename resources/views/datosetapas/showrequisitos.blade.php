@php
    $existen_datos=false;
@endphp
<form class="form-horizontal" method="post" action="/datosetapas">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="proceso_contractual_id" value="{{$proceso_contractual->id}}">
    @foreach ($requisitos as $requisito)
        @if ($requisito->etapas_id==$etapa->id)
            @php
                $existen_datos=true;
                $tipo_req=\App\Http\Controllers\DatosEtapaController::imprimir_tipo_requisitos($requisito->tipo_requisitos_id);
                $valor=\App\Http\Controllers\DatosEtapaController::busqueda_valor_dato_etapa($proceso_contractual->id, $requisito->id);
                $required="";
                $obligatorio="";
                if ($requisito->obligatorio=='1'){
                    $required="required";
                    $obligatorio="(*)";
                }
            @endphp
            @if( $tipo_req == 'checkbox')
                <div class="form-group">
                    <label class="control-label col-md-5" for="Input">{{$requisito->nombre}}:</label>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label><input type="checkbox" {{ $valor ? 'checked':''}} name="atributo[]" value="1" {{$required}}></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
            @elseif ( $tipo_req == 'textarea' )
                <div class="form-group">
                    <label class="control-label col-md-5" for="Input">{{$requisito->nombre}}: </label>
                    <div class="col-md-4">
                        <textarea rows="6" name="atributo[]" class="form-control" autocomplete="off" {{$required}}>{{$valor}}</textarea>
                    </div>
                </div>
                <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
                @else
                    <div class="form-group">
                        <label class="control-label col-md-5" for="Input">{{$requisito->nombre}} {{$obligatorio}}: </label>
                        <div class="col-md-4">
                            <input type="{{$tipo_req}}" name="atributo[]" class="form-control" value="{{$valor}}" autocomplete="off" {{$required}}>
                        </div>
                    </div>
                    <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
            @endif
        @endif
    @endforeach
    @if ($existen_datos==true)
        <form class="form-inline">
            <div align="center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    @else
        <h3>No hay información por diligenciar.</h3>
    @endif
</form>