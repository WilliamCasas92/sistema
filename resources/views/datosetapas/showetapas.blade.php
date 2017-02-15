<div>
    @foreach($etapas as $etapa)
        <div class="panel panel-default">
            @php
                $etapa_activa=\App\Http\Controllers\DatosEtapaController::busqueda_etapa_activa($proceso_contractual->id, $etapa->id);
                if($etapa_activa=='Activo'){
                    $color_panel_activo='panelcollapseactivo';
                    $color_body_activo='bodycollapseactivo';
                }else{
                    $color_panel_activo='panelcollapseinactivo';
                    $color_body_activo='bodycollapseinactivo';
                }
            @endphp
            <div class="panel-heading" id="{{$color_panel_activo}}">
                <h4 class="panel-title">
                    <a data-toggle="collapse"  href="#collapse{{ $etapa->id }}">{{ $etapa->nombre }}</a>
                </h4>
            </div>
            <div id="collapse{{ $etapa->id }}" class="panel-collapse collapse">
                <div class="panel-body" id="{{$color_body_activo}}">
                    <!-- ACA ES DONDE SALE EL FORMULARIO CON REQUISITOS-->
                    @include('datosetapas.showrequisitos', compact($proceso_contractual, $etapa, $requisitos, $etapa_activa))
                </div>
            </div>
        </div>
    @endforeach
</div>