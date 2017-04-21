@php($NoExist=false)
@if($procesos_contractuales->count())
    <tbody style="font-size : 11px;">
    @foreach($procesos_contractuales as $proceso_contractual)
        @php
            $etapa_usuario=\App\Http\Controllers\ProcesoContractualController::etapa_usuario($proceso_contractual->estado, $proceso_contractual->tipo_procesos_id);
        @endphp
        @if ($etapa_usuario==true)
            <tr>
            <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->numero_cdp }}</td>
            <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->year_cdp }}</td>
            <td style="font-size : 11px;" class="text-justify" width="35%">{{ $proceso_contractual->objeto }}</td>
            @if(($proceso_contractual->numero_contrato=='0')||($proceso_contractual->numero_contrato=='') )
                <td style="font-size : 11px;" class="text-center">Sin asignar.</td>
            @else
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->numero_contrato }}</td>
            @endif
            <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->dependencia }}</td>
            <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->tipo_proceso }}</td>
            <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->estado }}</td>
            <td class="text-center">
                @php
                    $enviar_adquisiciones='';
                    $recibir_adquisiciones='';
                    $diligenciar='';
                    $habilitar='';
                    $num_contrato='';
                    if($proceso_contractual->estado=='Sin enviar al Área de Adquisiciones.'){
                        if( (Auth::user()->hasRol('Administrador'))||
                                (Auth::user()->hasRol('Coordinador'))||
                                    (Auth::user()->hasRol('Secretario técnico de dependencia'))){
                            $enviar_adquisiciones='enabled';
                            $habilitar='enabled';
                        }
                    }elseif ($proceso_contractual->estado=='Enviado al Área de Adquisiciones.'){
                        if( (Auth::user()->hasRol('Administrador'))||
                                    (Auth::user()->hasRol('Coordinador'))||
                                        (Auth::user()->hasRol('Secretario')) ){
                            $recibir_adquisiciones='enabled';
                        }
                    }else{
                        if(Auth::user()->hasRol('Secretario técnico de dependencia')){
                            $diligenciar='disabled';
                        }else{
                            $diligenciar='enabled';
                            if( (Auth::user()->hasRol('Administrador'))||
                                   (Auth::user()->hasRol('Coordinador'))||
                                    (Auth::user()->hasRol('Gestor de contratación')) ){
                                $num_contrato='enabled';
                            }
                        }
                    }
                @endphp
                @if ($enviar_adquisiciones=='enabled')
                    <!-- Enviar a Adqui -->
                    <a href="{{ route('procesocontractual.enviar', array($proceso_contractual->id)) }}" class="btn btn-warning btn-xs">Enviar a Adquisiciones</a><br>
                @endif
                @if ($recibir_adquisiciones=='enabled')
                    <!-- Recibir a Adqui -->
                    <a href="{{ route('procesocontractual.recibir', array($proceso_contractual->id)) }}" class="btn btn-warning btn-xs">Recibir proceso en Adquisiciones</a><br>
                @endif
                @if ($diligenciar=='enabled')
                    <!-- Diligenciar -->
                    <a href="{{ route('datosetapas.menu', $proceso_contractual->id) }}" class="btn btn-success btn-xs">Diligenciar</a><br>
                @endif
                @if ($num_contrato=='enabled')
                    <!-- Asignar Número de contrato -->
                    @if((Auth::user()->hasRol('Administrador'))||(Auth::user()->hasRol('Coordinador')))
                            <br><div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">Opciones <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn-xs btn-block">
                                           Editar proceso</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route('historiales.mostrar', $proceso_contractual->id) }}" class="btn-xs btn-block">
                                            Ver registro de actividad</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route('procesocontractual.desertar', $proceso_contractual->id) }}" class="btn-xs btn-block">
                                            Desertar proceso</a></li>
                                    <li><a href="{{ route('procesocontractual.reanudar', $proceso_contractual->id) }}" class="btn-xs btn-block">
                                            Reiniciar proceso</a></li>
                                    <li>
                                        <a type="button" class="btn btn-xs btn-block" data-toggle="modal" data-target="#modalReanudar"
                                           data-href="{{ route('procesocontractual.reanudar', $proceso_contractual->id) }}" data-cdp="{{$proceso_contractual->numero_cdp }}" >
                                            Reiniciar proceso
                                        </a>
                                    </li>
                                    <li>
                                        <a type="button" class="btn btn-xs btn-block" data-toggle="modal" data-target="#modalDesertar"
                                           data-href="{{ route('procesocontractual.desertar', $proceso_contractual->id) }}" data-cdp="{{$proceso_contractual->numero_cdp }}" >
                                            Desertar Proceso
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                        <a href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn btn-info btn-xs">Asignar número de contrato</a><br>
                    @endif
                @endif
                @if($habilitar=='enabled')
                <br><div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">Opciones <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <!-- Editar -->
                            <li><a href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn-xs">Editar proceso</a></li>
                            <li class="divider"></li>
                            <!-- Eliminar -->
                            <li>
                                <button type="button" class="btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#modalDelete"
                                        data-url="{{ route('procesocontractual.destroy', $proceso_contractual->id) }}"
                                        data-cdp="{{$proceso_contractual->numero_cdp }}">Eliminar proceso</button>
                            </li>

                        </ul>
                    </div>
                @endif
            </td>
        </tr>
            @elseif ($etapa_usuario==$proceso_contractual->estado)
            <tr>
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->numero_cdp }}</td>
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->year_cdp }}</td>
                <td style="font-size : 11px;" class="text-justify" width="35%">{{ $proceso_contractual->objeto }}</td>
                @if(($proceso_contractual->numero_contrato=='0')||( $proceso_contractual->numero_contrato=='' ) )
                    <td style="font-size : 11px;" class="text-center">Sin asignar.</td>
                @else
                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->numero_contrato }}</td>
                @endif
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->dependencia }}</td>
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->tipo_proceso }}</td>
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->estado }}</td>
                <td class="text-center">
                @php
                    $enviar_adquisiciones='';
                    $recibir_adquisiciones='';
                    $diligenciar='';
                    $habilitar='';
                    $num_contrato='';
                    if($proceso_contractual->estado=='Sin enviar al Área de Adquisiciones.'){
                        if( (Auth::user()->hasRol('Administrador'))||
                                (Auth::user()->hasRol('Coordinador'))||
                                    (Auth::user()->hasRol('Secretario técnico de dependencia'))){
                            $enviar_adquisiciones='enabled';
                            $habilitar='enabled';
                        }
                    }elseif ($proceso_contractual->estado=='Enviado al Área de Adquisiciones.'){
                        if( (Auth::user()->hasRol('Administrador'))||
                                    (Auth::user()->hasRol('Coordinador'))||
                                        (Auth::user()->hasRol('Secretario')) ){
                            $recibir_adquisiciones='enabled';
                        }
                    }else{
                        if(Auth::user()->hasRol('Secretario técnico de dependencia')){
                            $diligenciar='disabled';
                        }else{
                            $diligenciar='enabled';
                            if( (Auth::user()->hasRol('Administrador'))||
                                   (Auth::user()->hasRol('Coordinador'))||
                                    (Auth::user()->hasRol('Gestor de contratación')) ){
                                $num_contrato='enabled';
                            }
                        }
                    }
                @endphp
                @if ($enviar_adquisiciones=='enabled')
                    <!-- Enviar a Adqui -->
                        <a href="{{ route('procesocontractual.enviar', array($proceso_contractual->id)) }}" class="btn btn-warning btn-xs">Enviar a Adquisiciones</a><br>
                @endif
                @if ($recibir_adquisiciones=='enabled')
                    <!-- Recibir a Adqui -->
                        <a href="{{ route('procesocontractual.recibir', array($proceso_contractual->id)) }}" class="btn btn-warning btn-xs">Recibir proceso en Adquisiciones</a><br>
                @endif
                @if ($diligenciar=='enabled')
                    <!-- Diligenciar -->
                        <a href="{{ route('datosetapas.menu', $proceso_contractual->id) }}" class="btn btn-success btn-xs">Diligenciar</a><br>
                @endif
                @if ($num_contrato=='enabled')
                    <!-- Asignar Número de contrato -->
                    @if((Auth::user()->hasRol('Administrador'))||(Auth::user()->hasRol('Coordinador')))
                        <br><div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">Opciones</button>
                                <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li><a href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn-xs btn-block">
                                        Editar proceso</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route('procesocontractual.desertar', $proceso_contractual->id) }}" class="btn-xs btn-block">
                                        Desertar proceso</a></li>
                                <li><a href="{{ route('procesocontractual.reanudar', $proceso_contractual->id) }}" class="btn-xs btn-block">
                                        Reiniciar proceso</a></li>
                                <li>
                                    <a type="button" class="btn btn-xs btn-block" data-toggle="modal" data-target="#modalReanudar"
                                       data-href="{{ route('procesocontractual.reanudar', $proceso_contractual->id) }}" data-cdp="{{$proceso_contractual->numero_cdp }}" >
                                        Reiniciar proceso
                                    </a>
                                </li>
                                <li>
                                    <a type="button" class="btn btn-xs btn-block" data-toggle="modal" data-target="#modalDesertar"
                                       data-href="{{ route('procesocontractual.desertar', $proceso_contractual->id) }}" data-cdp="{{$proceso_contractual->numero_cdp }}" >
                                        Desertar Proceso
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn btn-info btn-xs">Asignar número de contrato</a><br>
                    @endif
                @endif
                @if($habilitar=='enabled')
                <br><div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">Opciones</button>
                        <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown">
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <!-- Editar -->
                            <li><a href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn-xs">Editar proceso</a></li>
                            <li class="divider"></li>
                            <!-- Eliminar -->
                            <li>
                                <button type="button" class="btn btn-danger btn-xs btn-block" data-toggle="modal" data-target="#modalDelete"
                                        data-url="{{ route('procesocontractual.destroy', $proceso_contractual->id) }}"
                                        data-cdp="{{$proceso_contractual->numero_cdp }}">Eliminar proceso</button>
                            </li>
                        </ul>
                    </div>
                @endif
                </td>
            </tr>
            @else
            <tr>
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->numero_cdp }}</td>
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->year_cdp }}</td>
                <td style="font-size : 11px;" class="text-justify" width="35%">{{ $proceso_contractual->objeto }}</td>
                @if(($proceso_contractual->numero_contrato=='0')||($proceso_contractual->numero_contrato==''))
                    <td style="font-size : 11px;" class="text-center">Sin asignar.</td>
                @else
                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->numero_contrato }}</td>
                @endif
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->dependencia }}</td>
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->tipo_proceso }}</td>
                <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->estado }}</td>
                <td class="text-center">
                    <a href="{{ route('consulta.consultavermas', $proceso_contractual->id) }}" class="btn btn-info btn-xs">Ver más</a><br>
                </td>
            </tr>
        @endif
    </tbody>
    @endforeach
    @include('procesocontractual.modaldeleteproceso')
    @include('procesocontractual.modaldesertarproceso')
    @include('procesocontractual.modalreanudarproceso')
@endif
