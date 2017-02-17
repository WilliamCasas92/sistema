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
                <label class="control-label" for="InputName">Filtro de búsqueda:</label>
                <input type="text" name="" class="form-control" autocomplete="off" placeholder="" disabled>
                <br><br>
                <!-- Tabla de Indice de Procesos creados-->
                <div class="table-responsive">
                    @if($procesos_contractuales)
                        <table class="table table-hover">
                            <thead style="font-size : 11px;">
                            <tr>
                                <th class="text-center">CDP</th>
                                <th class="text-center" width="35%">Objeto</th>
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
                                    <td style="font-size : 11px;" class="text-center" width="35%">{{ $proceso_contractual->objeto }}</td>
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->dependencia }}</td>
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->tipo_proceso }}</td>
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->created_at }}</td>
                                    <td style="font-size : 11px;" class="text-center">{{ $proceso_contractual->fecha_aprobacion }}</td>
                                    <td class="text-center">
                                        @php
                                            if($proceso_contractual->estado==''){
                                                $enviar_adquisiciones='enabled';
                                                $texto_enviar='Enviar a Adquisiciones';
                                                $diligenciar='disabled';
                                                $editar='enabled';
                                                $eliminar='enabled';
                                            }else{
                                                $enviar_adquisiciones='disabled';
                                                $texto_enviar='Enviado a Adquisiciones';
                                                $diligenciar='enabled';
                                                $editar='enabled';
                                                $eliminar='disabled';
                                            }
                                        @endphp
                                        <a href="{{ route('procesocontractual.enviar', array($proceso_contractual->id, Auth::user()->id)) }}" class="btn btn-warning btn-xs {{$enviar_adquisiciones}} ">{{$texto_enviar}}</a><br>
                                        <a href="{{ route('datosetapas.menu', $proceso_contractual->id) }}" class="btn btn-success btn-xs {{$diligenciar}} ">Diligenciar</a><br>
                                        <a {{$editar}} href="{{ route('procesocontractual.edit', $proceso_contractual->id) }}" class="btn btn-info btn-xs">Editar</a><br>
                                        @if($eliminar=='enabled')
                                            <form action="{{ route('procesocontractual.destroy', $proceso_contractual->id) }}"method="post">
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-danger btn-xs ">Eliminar</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection