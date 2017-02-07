<div>
    @foreach($etapas as $etapa)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse"  href="#collapse{{ $etapa->id }}">{{ $etapa->nombre }}</a>
                </h4>
            </div>
            <div id="collapse{{ $etapa->id }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <form class="form-horizontal">
                        @foreach ($requisitos as $requisito)
                            @if ($requisito->etapas_id==$etapa->id)
                                <div class="checkbox">
                                    <label class="control-label col-md-4" for="InputName">{{$requisito->nombre}}</label>
                                    <div class="col-md-4">
                                        <input type="{{\App\Http\Controllers\DatosEtapaController::imprimir_tipo_requisitos($requisito->tipo_requisitos_id)}}" name="{{$requisito->nombre}}" class="form-control">
                                    </div>
                                </div>
                                <br>
                            @endif
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>