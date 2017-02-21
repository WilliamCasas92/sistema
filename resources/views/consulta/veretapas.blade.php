<div>
    @foreach($etapas as $etapa)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <label>{{ $etapa->nombre }}</label>
                    <a data-toggle="collapse"  href="#collapse{{ $etapa->id }}">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                        </a>
                </h4>
            </div>
            <div id="collapse{{ $etapa->id }}" class="panel-collapse collapse">
                <div class="panel-body">
                    @include('consulta.verdatos', compact($proceso_contractual, $etapa, $requisitos))
                </div>
            </div>
        </div>
    @endforeach
</div>