@extends('master')
@section('indexuser')
    <div class="container">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Usuarios Registrados</h3></div>
            <div class="panel-body">
                <div align="left">
                    <h4><a class="btn btn-primary" href="{{route('users.create')}}">Crear nuevo usuario</a></h4>
                </div>
                <div class="table-responsive">
                    @if($data)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Nombres</th>
                                <th class="text-center">Apellidos</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Fecha de creación</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $row)
                                <tr>
                                    <td class="text-center">{{ $row->nombre }}</td>
                                    <td class="text-center">{{ $row->apellidos }}</td>
                                    <td class="text-center">{{ $row->email }}</td>
                                    <td class="text-center">{{ $row->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $row->id) }}" class="btn btn-info btn-xs">Editar</a>
                                        <form action="{{ route('users.destroy', $row->id) }}" method="post">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                                        </form>
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