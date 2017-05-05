<div>
    @foreach($etapas as $etapa)
        <div class="panel panel-default">
            @php
                $etapa_activa=\App\Http\Controllers\DatosEtapaController::busqueda_etapa_activa($proceso_contractual->id, $etapa->id);
                if(
                    ( ($etapa->hasRol('Administrador')) && (Auth::user()->hasRol('Administrador'))) ||
                    ( ($etapa->hasRol('Coordinador'))   && ((Auth::user()->hasRol('Coordinador')) || (Auth::user()->hasRol('Administrador'))) ) ||
                    ( ($etapa->hasRol('Secretario'))    && ((Auth::user()->hasRol('Secretario')) || (Auth::user()->hasRol('Coordinador')) || (Auth::user()->hasRol('Administrador'))) ) ||
                    ( ($etapa->hasRol('Abogado'))    && ((Auth::user()->hasRol('Abogado')) || (Auth::user()->hasRol('Coordinador')) || (Auth::user()->hasRol('Administrador'))) ) ||
                    ( ($etapa->hasRol('Gestor de contratación'))    && ((Auth::user()->hasRol('Gestor de contratación')) || (Auth::user()->hasRol('Coordinador')) || (Auth::user()->hasRol('Administrador'))) ) ||
                    ( ($etapa->hasRol('Gestor de notificación'))    && ((Auth::user()->hasRol('Gestor de notificación')) || (Auth::user()->hasRol('Coordinador')) || (Auth::user()->hasRol('Administrador'))) ) ||
                    ( ($etapa->hasRol('Gestor de afiliación'))    && ((Auth::user()->hasRol('Gestor de afiliación')) || (Auth::user()->hasRol('Coordinador')) || (Auth::user()->hasRol('Administrador'))) ) ||
                    ( ($etapa->hasRol('Gestor de archivo'))    && ((Auth::user()->hasRol('Gestor de archivo')) || (Auth::user()->hasRol('Coordinador')) || (Auth::user()->hasRol('Administrador'))) ) ||
                    ( ($etapa->hasRol('Gestor de publicación'))    && ((Auth::user()->hasRol('Gestor de publicación')) || (Auth::user()->hasRol('Coordinador')) || (Auth::user()->hasRol('Administrador'))) )
                    ){
                    if($etapa_activa=='Activo'){
                        $color_panel_activo='panelcollapseactivo';
                        $color_body_activo='bodycollapseactivo';
                    }else{
                        $etapa_activa='';
                        $color_panel_activo='';
                        $color_body_activo='';
                    }
                }else{
                    $etapa_activa='';
                    $color_panel_activo='';
                    $color_body_activo='';
                }
            @endphp
            <div class="panel-heading" id="{{$color_panel_activo}}">
                <a data-toggle="collapse"  href="#collapse{{ $etapa->id }}">
                <h4 class="panel-title">
                    <label class="text-success" onmouseover="this.style.cursor='pointer';">{{ $etapa->nombre }}</label>
                </h4></a>
            </div>
            <div id="collapse{{ $etapa->id }}" class="panel-collapse collapse">
                <div class="panel-body" id="{{$color_body_activo}}">
                    <!-- ACA ES DONDE SALE EL FORMULARIO CON REQUISITOS-->
                    @include('datosetapas.showrequisitos', compact($proceso_contractual, $etapa, $requisitos, $etapa_activa))
                </div>
            </div>
        </div>
    @endforeach
        @include('datosetapas.modalsave')
        <div class="modal" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="modalMensaje" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document" id="datos_faltantes">

            </div>
        </div>
</div>