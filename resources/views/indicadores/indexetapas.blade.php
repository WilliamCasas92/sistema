@foreach($etapas as $etapa)
        <div class="panel panel-info">
            <div class="panel-heading">
                <a data-toggle="collapse"  href="#indicador{{$etapa->id}}">
                    <h4 class="panel-title">
                        <label class="text-info">{{$etapa->nombre}}</label>
                    </h4></a>
            </div>
            <div id="indicador{{$etapa->id}}" class="panel-collapse collapse">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">Indicador</th>
                            <th class="text-center">Número de Procesos</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <td>Actualmente en {{$etapa->nombre}}</td>
                            @php($cantidad_proceso_etapa=\App\Http\Controllers\IndicadoresController::cantidad_procesos_etapa($tipo_proceso->nombre, $etapa->nombre))
                            <td>{{$cantidad_proceso_etapa}} proceso(s).</td>
                        </tr>
                        <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">Tiempo Promedio</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <td>En el Área de Aquisiciones</td>
                            @php($tiempo_promedio=\App\Http\Controllers\IndicadoresController::tiempo_promedio_etapa($tipo_proceso->nombre, $tipo_proceso->id, $etapa->id, $etapa->nombre, $etapa->indice))
                            <td>{{$tiempo_promedio}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endforeach

