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
                    <h4>Diligencie los siguientes datos: </h4><br>
                    Campos obligatorios (*)<br><br>
                    <!-- ACA ES DONDE SALE EL FORMULARIO CON REQUISITOS-->
                    @include('datosetapas.showrequisitos', compact($proceso_contractual, $etapa, $requisitos))
                </div>
            </div>
        </div>
    @endforeach
</div>