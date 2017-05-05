<div>
    @foreach($etapas as $etapa)
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse"  href="#collapse{{ $etapa->id }}">
                <h4 class="panel-title">
                    <label onmouseover="this.style.cursor='pointer';" class="text-success">{{$etapa->nombre}}</label>
                </h4>
                </a>
            </div>
            <div id="collapse{{ $etapa->id }}" class="panel-collapse collapse">
                <div class="panel-body">
                    @include('consulta.verdatos', compact($proceso_contractual, $etapa, $requisitos))
                </div>
            </div>
        </div>
    @endforeach
</div>