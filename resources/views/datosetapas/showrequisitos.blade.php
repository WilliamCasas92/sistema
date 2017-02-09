@php
    $existen_datos=false;
@endphp
<form class="form-horizontal" method="post" action="/datosetapas">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <h4>Hola</h4>
    <input type="text" name="proceso_contractual_id" value="{{$proceso_contractual->id}}">
    @foreach ($requisitos as $requisito)
        @if ($requisito->etapas_id==$etapa->id)
            @php
                $existen_datos=true;
                $tipo_req=\App\Http\Controllers\DatosEtapaController::imprimir_tipo_requisitos($requisito->tipo_requisitos_id)
            @endphp
            @if( $tipo_req == 'checkbox')
                <div class="form-group">
                    <label class="control-label col-md-5" for="InputActivo">{{$requisito->nombre}}:</label>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label><input type="checkbox" name="atributo[]" value="1"></label>
                        </div>
                    </div>
                </div>
                <input type="text" name="requisito_id[]" value="{{$requisito->id}}">
            @else
                <div class="form-group">
                    <label class="control-label col-md-5" for="Input">{{$requisito->nombre}}:</label>
                    <div class="col-md-4">
                        <input type="{{$tipo_req}}" name="atributo[]" class="form-control" autocomplete="off">
                    </div>
                </div>
                <input type="text" name="requisito_id[]" value="{{$requisito->id}}">
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