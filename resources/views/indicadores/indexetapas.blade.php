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
                            <th class="text-center" width="52%">Indicador</th>
                            <th class="text-center">Número de Procesos</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <td>Actualmente en {{$etapa->nombre}}</td>
                            @php($cantidad_proceso_etapa=\App\Http\Controllers\IndicadoresController::cantidad_procesos_etapa($tipo_proceso->nombre, $etapa->nombre))
                            <td>{{$cantidad_proceso_etapa}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center">Tiempo Promedio</th>
                            <th class="text-center"></th>
                        </tr>
                        <tr style="font-size : 12px;">
                            <th class="text-center" width="30%"></th>
                            <th class="text-center" width="10%">Días</th>
                            <th class="text-center" width="10%">Horas</th>
                            <th class="text-center" width="10%">Minutos</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <td>En el Área de Aquisiciones</td>
                            @php($tiempo_promedio_dia=\App\Http\Controllers\IndicadoresController::tiempo_promedio_etapa($tipo_proceso->nombre, $tipo_proceso->id, $etapa->id, $etapa->nombre, $etapa->indice, 'dia'))
                            <td>{{$tiempo_promedio_dia}}</td>
                            @php($tiempo_promedio_hora=\App\Http\Controllers\IndicadoresController::tiempo_promedio_etapa($tipo_proceso->nombre, $tipo_proceso->id, $etapa->id, $etapa->nombre, $etapa->indice, 'hora'))
                            <td>{{$tiempo_promedio_hora}}</td>
                            @php($tiempo_promedio_min=\App\Http\Controllers\IndicadoresController::tiempo_promedio_etapa($tipo_proceso->nombre, $tipo_proceso->id, $etapa->id, $etapa->nombre, $etapa->indice, 'minuto'))
                            <td>{{$tiempo_promedio_min}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endforeach