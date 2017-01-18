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
                    @if($data)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Activo</th>
                                <th class="text-center">Fecha de creación</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $row)
                                <tr>
                                    <td class="text-center">{{ $row->nombre }}</td>
                                    <td class="text-center">{{ $row->activo }}</td>
                                    <td class="text-center">{{ $row->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tipoproceso.edit', $row->id) }}" class="btn btn-info btn-xs">Editar</a>
                                        <form action="{{ route('tipoproceso.destroy', $row->id) }}" method="post">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                                        </form>
                                        <a href="{{ route('etapa.create') }}" class="btn btn-success btn-xs">Gestionar Etapas</a>
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