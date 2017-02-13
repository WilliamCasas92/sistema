@extends('master')
@section('indexprocesstype')
    <div class="container col-md-9">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Tipos de Procesos Registrados</h3></div>
            <div class="panel-body">
                <div align="left">
                    <h4><a class="btn btn-primary" href="{{route('tipoproceso.create')}}">Crear nuevo Tipo de Proceso de Contratación</a></h4>
                </div>
                <div class="table-responsive">
                    @if($tipos_procesos)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Versión</th>
                                <th class="text-center">Activo</th>
                                <th class="text-center">Fecha de creación</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tipos_procesos as $tipo_proceso)
                                <tr>
                                    <td class="text-center">{{ $tipo_proceso->nombre }}</td>
                                    <td class="text-center">{{ $tipo_proceso->version }}</td>
                                    @if ($tipo_proceso->activo==1)
                                        <td class="text-center"><span class="glyphicon glyphicon-ok"></span></td>
                                        @else
                                        <td class="text-center"><span class="glyphicon glyphicon-ban-circle"></span></td>
                                    @endif
                                    <td class="text-center">{{ $tipo_proceso->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tipoproceso.edit', $tipo_proceso->id) }}" class="btn btn-info btn-xs">Editar</a>
                                        <form action="{{ route('tipoproceso.destroy', $tipo_proceso->id) }}" method="post">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                                        </form>
                                        <a href="{{ route('etapa.almacenar', $tipo_proceso, 'tipo_proceso') }}" class="btn btn-success btn-xs">Gestionar Etapas</a>
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