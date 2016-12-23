<div class="container">

    <h1>Usuarios Registrados</h1>

    <h4><a href="{{route('users.create')}}">Crear nuevo usuario</a></h4>
    <hr>

    <div class="table-responsive">
        @if($data)
            <table class="table">
                <thead>
                <tr>
                    <td>Nombres</td>
                    <td>Apellidos</td>
                    <td>Email</td>
                    <td>Creado</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->nombre }}</td>
                        <td>{{ $row->apellidos }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>
                            <a href="{{ route('users.edit', $row->id) }}" class="btn btn-info">Editar</a>
                            <form action="{{ route('users.destroy', $row->id) }}" method="post">
                                <input name="_method" type="hidden" value="DELETE">
                                <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        @endif
    </div>
</div>