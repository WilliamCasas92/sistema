<div class="panel panel-success">
    @php($exiten=false)
    <div class="panel-heading text-center"><strong>¡Estos son los nuevos procesos de contratación que estan por atender!</strong></div>
    <div class="panel-body">
        @php($procesos_contractuales=\App\Http\Controllers\ProcesoContractualController::procesos_contractuales_orderby())
        @foreach ($procesos_contractuales as $proceso_contractual)
            @php($etapa_usuario=\App\Http\Controllers\ProcesoContractualController::etapa_usuario($proceso_contractual->estado, $proceso_contractual->tipo_procesos_id))
            @if(($etapa_usuario==true) && ($proceso_contractual->estado!='Finalizado'))
                <div class="well text-justify">
                    <strong>Fecha de llegada: </strong> {{$proceso_contractual->updated_at->format('l d \d\e F \d\e Y, h:i:s A')}}<br>
                    <strong>Modalidad:</strong> {{$proceso_contractual->tipo_proceso}}.<br>
                    <strong>CDP:</strong> {{$proceso_contractual->numero_cdp}}.<br>
                    <strong>Objeto:</strong> {{$proceso_contractual->objeto}}<br>
                    <strong>Estado:</strong> {{$proceso_contractual->estado}}<br><br>
                    <div class="text-center">
                        @if($proceso_contractual->estado=='Sin enviar al Área de Adquisiciones.')
                            <a href="{{ route('procesocontractual.enviar', array($proceso_contractual->id)) }}" class="btn btn-warning btn-sm">Enviar a Adquisiciones</a>
                            @elseif($proceso_contractual->estado=='Enviado al Área de Adquisiciones.')
                                <a href="{{ route('procesocontractual.recibir', array($proceso_contractual->id)) }}" class="btn btn-warning btn-sm">Recibir proceso en Adquisiciones</a>
                            @else
                                <a href="{{ route('datosetapas.menu', $proceso_contractual->id) }}" class="btn btn-success btn-sm">¡Diligenciar ahora!</a>
                        @endif
                    </div>
                </div>
                @php($exiten=true)
            @endif
        @endforeach
        @if($exiten==false)
            <div class="well text-center">
                <strong>No tienes procesos por atender.</strong><br>
            </div>
        @endif
    </div>
</div>
