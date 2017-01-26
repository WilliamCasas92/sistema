@extends('master')
@section('indexcontractualprocess')
    <div class="container col-md-9">
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
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">CDP</th>
                            <th class="text-center">Objeto</th>
                            <th class="text-center">Dependencia</th>
                            <th class="text-center">Fecha de creación</th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <a href="" class="btn btn-success btn-xs disabled">Check</a>
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-info btn-xs disabled">Editar</a>
                                    <form action="" method="post">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden"  value="">
                                        <button type="submit" class="btn btn-danger btn-xs disabled">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection