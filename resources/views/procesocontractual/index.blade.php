@extends('master')
@section('indexcontractualprocess')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Procesos Contractuales</h3></div>
            <div class="panel-body">
                <div align="left">
                    <h4><a class="btn btn-primary" href="{{route('procesocontractual.create')}}">Crear nuevo proceso de contratación</a></h4>
                </div><br>
                <!-- Seccion para la busqueda-->
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>Filtrar búsqueda
                                <a data-toggle="collapse"  data-parent="#accordion" href="#collapseconsulta">
                                        <span class="glyphicon glyphicon-search"></span>
                                </a></h5>
                        </div>
                        <div id="collapseconsulta" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="well" name="FiltrosDeBusqueda">
                                    <form class="form-horizontal" method="get" role="buscar" action="{{url('procesocontractual')}}">
                                        <div class="form-group">
                                            <h6><label class="control-label col-md-2" for="NumCDP">Número de CDP: </label></h6>
                                            <div class="col-md-3">
                                                <input type="text" name="NumCDP" class="form-control" placeholder="Número de CDP">
                                            </div>
                                            <h6><label class="control-label col-md-3" for="NumContrato">Número de Contrato: </label></h6>
                                            <div class="col-md-3">
                                                <input type="text" name="NumContrato" class="form-control" autocomplete="off" placeholder="Número de contrato">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h6><label class="control-label col-md-2" for="TipoProceso">Tipo de Proceso de Contratación: </label></h6>
                                            <div class="col-md-4">
                                                <select class="form-control" name="TipoProceso" id="TipoProceso">
                                                    <option value="">Seleccione una opción</option>
                                                    @foreach($tipos_procesos as $tipo_proceso)
                                                        <option value="{{$tipo_proceso->nombre}}">{{$tipo_proceso->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <h6><label class="control-label col-md-2" for="Dependencia">Depedencia: </label></h6>
                                            <div class="col-md-4">
                                                <select class="form-control" name="dependencia" id="Dependencia">
                                                    <option value="">Seleccione una opción</option>
                                                    <option value="Rectoría">Rectoría</option>
                                                    <option value="Vicerrectoría de Docencia e Investigación">Vicerrectoría de Docencia e Investigación</option>
                                                    <option value="Vicerrectoría de Extensión">Vicerrectoría de Extensión</option>
                                                    <option value="Vicerrectoría Administrativa">Vicerrectoría Administrativa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h6><label class="control-label col-md-2" for="Objeto">Objeto: </label></h6>
                                            <div class="col-md-4">
                                                <textarea rows="5" name="Objeto" class="form-control" autocomplete="off" placeholder="Objeto del contrato"></textarea>
                                            </div>
                                        </div>
                                        <form class="form-inline">
                                            <div align="center">
                                                <br><button type="submit" class="btn btn-primary">Buscar</button>
                                            </div>
                                        </form>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabla de Indice de Procesos creados-->
                <div class="table-responsive">
                    @if($procesos_contractuales->count())
                        <table class="table table-hover">
                            <thead style="font-size : 11px;">
                            <tr>
                                <th class="text-center">CDP</th>
                                <th class="text-center">Año</th>
                                <th class="text-center" width="35%">Objeto</th>
                                <th class="text-center">Número de contrato</th>
                                <th class="text-center">Dependencia</th>
                                <th class="text-center">Tipo de Proceso</th>
                                <th class="text-center">Fecha de creación</th>
                                <th class="text-center">Fecha de Aprobación</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody style="font-size : 11px;">
                            @foreach($procesos_contractuales as $proceso_contractual)
                                <tr>
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->numero_cdp }}</td>
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->year_cdp }}</td>
                                    <td style="font-size : 11px;" class="text-justify" width="35%">{{ $proceso_contractual->objeto }}</td>
                                    @if($proceso_contractual->numero_contrato!='')
                                        <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->numero_contrato }}</td>
                                    @else
                                        <td style="font-size : 11px;" class="text-center">Sin asignar.</td>
                                    @endif
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->dependencia }}</td>
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->tipo_proceso }}</td>
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->created_at }}</td>
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->fecha_aprobacion }}</td>
                                    <td class="text-center">
                                        @php
                                            if($proceso_contractual->estado=='Sin enviar al Área de Adquisiciones.'){
                                                $enviar_adquisiciones='enabled';
                                                $texto_enviar='Enviar a Adquisiciones';
                                                $diligenciar='disabled';
                                                $editar='enabled';
                                                $eliminar='enabled';
                                            }else{
                                                $enviar_adquisiciones='disabled';
                                                $texto_enviar='Enviado al Área de Adquisiciones.';
                                                $diligenciar='enabled';
                                                $editar='enabled';
                                                $eliminar='disabled';
                                            }
                                        @endphp

                                        @if( (Auth::user()->hasRol('Secretario técnico de dependencia')) ||
                                                (Auth::user()->hasRol('Administrador')))
                                            <a href="{{ route('procesocontractual.enviar', array($proceso_contractual->id)) }}" class="btn btn-warning btn-xs {{$enviar_adquisiciones}} ">{{$texto_enviar}}</a><br>
                                            <a {{$editar}} href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn btn-info btn-xs">Editar proceso</a><br>
                                            @if( (Auth::user()->hasRol('Administrador')) )
                                                <a href="{{ route('datosetapas.menu', $proceso_contractual->id) }}" class="btn btn-success btn-xs {{$diligenciar}} ">Diligenciar</a><br>
                                            @endif
                                        @if($eliminar=='enabled')
                                                <form action="{{ route('procesocontractual.destroy', $proceso_contractual->id) }}"method="post">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-danger btn-xs ">Eliminar</button>
                                                </form>
                                            @endif
                                        @endif
                                        @if( (Auth::user()->hasRol('Secretario')) ||
                                                (Auth::user()->hasRol('Coordinador')) )
                                            <a href="{{ route('datosetapas.menu', $proceso_contractual->id) }}" class="btn btn-success btn-xs {{$diligenciar}} ">Diligenciar</a><br>
                                        @endif

                                        @if( (Auth::user()->hasRol('Coordinador')) )
                                            <a {{$editar}} href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn btn-info btn-xs">Editar proceso</a><br>
                                        @endif

                                        @if( (Auth::user()->hasRol('Abogado')) ||
                                                (Auth::user()->hasRol('Gestor de notificación')) ||
                                                (Auth::user()->hasRol('Gestor de afiliación')) ||
                                                (Auth::user()->hasRol('Gestor de archivo')) ||
                                                (Auth::user()->hasRol('Gestor de publicación')) )
                                            <a href="{{ route('datosetapas.menu', $proceso_contractual->id) }}" class="btn btn-success btn-xs {{$diligenciar}} ">Diligenciar</a><br>
                                        @endif

                                        @if( (Auth::user()->hasRol('Gestor de contratación')))
                                            <a href="{{ route('datosetapas.menu', $proceso_contractual->id) }}" class="btn btn-success btn-xs {{$diligenciar}} ">Diligenciar</a><br>
                                            <a {{$editar}} href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn btn-info btn-xs">Añadir número de contrato</a><br>
                                        @endif



                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    @else
                        <h4 class="well" align="center">No existen procesos disponibles.</h4>
                    @endif
                    {{$procesos_contractuales->appends(Request::all())->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection