@foreach($etapas as $etapa)
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse"  href="#indicador{{$etapa->id}}">
                    <h4 class="panel-title">
                        <label class="text-info">{{$etapa->nombre}}</label>
                    </h4></a>
            </div>
            <div id="indicador{{$etapa->id}}" class="panel-collapse collapse">
                <div class="panel-body">
                    @php($cantidad_proceso_etapa=\App\Http\Controllers\IndicadoresController::cantidad_procesos_etapa($tipo_proceso->nombre, $etapa->nombre))
                    <p>Cantidad de procesos en esta etapa: {{$cantidad_proceso_etapa}} proceso(s).</p>
                    @php($tiempo_promedio=\App\Http\Controllers\IndicadoresController::tiempo_promedio_etapa($tipo_proceso->nombre, $tipo_proceso->id, $etapa->id, $etapa->nombre, $etapa->indice))
                    <p>Tiempo promedio en esta etapa: {{$tiempo_promedio}}</p>
                </div>
            </div>
        </div>
@endforeach

