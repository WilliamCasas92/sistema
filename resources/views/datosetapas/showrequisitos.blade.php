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
                    //cuando se vaya a pasar de etapa, se activa el required
                    $required="";
                    $obligatorio="(*)";
                }
            @endphp
            @if( $tipo_req == 'checkbox')
                <div class="form-group">
                    <label class="control-label col-md-5" for="Input">{{$requisito->nombre}}:</label>
                    <div class="col-md-4">
                        <div class="checkbox">
                            @if($valor=="")
                                @php
                                    $valor_checked='1';
                                    $valor_unchecked='0';
                                @endphp
                                <h4>Llego vacio y enviare: {{$valor_checked}} si lo marco.
                                    Si no marco envio {{$valor_unchecked}}.</h4>
                                <input id='checkbox' type='checkbox' value='{{$valor_checked}}' name='atributo[]'>
                                <input id='checkboxHidden' type='hidden' value='{{$valor_unchecked}}' name='atributo[]'>
                                <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
                            @else
                                @php
                                    $valor_checked='1';
                                    $valor_unchecked='0';
                                @endphp
                                <h4>Me llego este dato: {{$valor}}</h4>
                                <h4>Pero enviare : {{$valor_checked}} si lo marco. sino {{$valor_unchecked}}</h4>
                                <input id='checkbox' type='checkbox' value='{{$valor_checked}}' name='atributo[]'>
                                <input id='checkboxHidden' type='hidden' value='{{$valor_unchecked}}' name='atributo[]'>
                                <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
                            @endif
                        </div>
                    </div>
                </div>
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

@section('MyscriptsDiligenciar')
    <script>
        $(document).ready(function() {
            if(document.getElementById("checkbox").checked) {
                document.getElementById('checkboxHidden').disabled = true;
            }
        })
    </script>
@endsection