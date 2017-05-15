@extends('master')
@section('consultacontent')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><label style="font-size : 25px;">Procesos de Contratación</label></div>
            <div class="panel-body">

                @if( (Auth::user()->hasRol('Administrador'))||
                        (Auth::user()->hasRol('Coordinador'))||
                            (Auth::user()->hasRol('Secretario técnico de dependencia')) )
                    <div align="center">
                        <h4><a class="btn btn-primary btn-sm" href="{{route('procesocontractual.create')}}">Nuevo proceso de contratación</a></h4>
                    </div><br>
                @endif
                <!-- Tabla de Indice de Procesos creados-->
                <div name="ResultadosDeBusqueda">
                    <div class=" well table-responsive">
                            <table class="table table-hover">
                                <thead style="font-size : 11px;">
                                <tr>
                                    <th class="text-center">CDP</th>
                                    <th class="text-center">Año</th>
                                    <th class="text-center" width="35%">Objeto</th>
                                    <th class="text-center">Número de contrato</th>
                                    <th class="text-center">Dependencia</th>
                                    <th class="text-center">Tipo de Proceso</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <tr>
                                    <form class="form-horizontal" method="post" role="buscar" action="{{url('consultaproceso')}}">
                                        {{csrf_field()}}
                                        <td><input type="text" name="NumCDP" class="form-control input-sm" ></td>
                                        <td><input name="AnoCDP" class="form-control input-sm" autocomplete="off" ></td>
                                        <td><input name="Objeto" class="form-control input-sm" autocomplete="off" ></td>
                                        <td><input type="text" name="NumContrato" class="form-control input-sm" autocomplete="off"></td>
                                        <td>
                                            <select class="form-control input-sm" name="dependencia" id="Dependencia">
                                                <option value=""></option>
                                                <option value="Rectoría">Rectoría</option>
                                                <option value="Vicerrectoría de Docencia e Investigación">Vicerrectoría de Docencia e Investigación</option>
                                                <option value="Vicerrectoría de Extensión">Vicerrectoría de Extensión</option>
                                                <option value="Vicerrectoría Administrativa">Vicerrectoría Administrativa</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control input-sm" name="TipoProceso"  id="TipoProceso">
                                                <option value=""></option>
                                                @foreach($tipos_procesos as $tipo_proceso)
                                                    <option value="{{$tipo_proceso->nombre}}">{{$tipo_proceso->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            @if(isset($mostrar_todos))
                                                <a class="btn-info btn btn-xs" href="{{route('consulta.mostrar')}}">Ver Todos</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="submit" class="btn btn-primary btn-xs">Filtrar</button>

                                        </td>
                                    </form>
                                </tr>
                                @if($procesos_contractuales->count())
                                    <!-- Tabla de Indice de Procesos a diligenciar-->
                                    @include('procesocontractual.index', compact($procesos_contractuales, $tipos_procesos))

                            </table>
                                @else
                            </table>
                                    <h4 class="well" align="center">No existen coincidencias con la búsqueda</h4>
                                @endif

                       {{$procesos_contractuales->appends(Request::all())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptconsultacontent')
    <script>
        $(document).ready(function() {
            //Con este Script se envian los datos al modal eliminar proceso_contractual
            //El cual es llamado vista index.blade de la carpeta proceso contractual
            $(function() {
                $('#modalDelete').on("show.bs.modal", function (e) {
                    $("#modalDeleteCdp").html($(e.relatedTarget).data('cdp'));
                    $("#modalDeleteForm").attr('action', $(e.relatedTarget).data('url'));
                });
            });
            //Con este Script se envian los datos al modal Reanudar proceso_contractual
            //El cual es llamado en la vista index.blade de la carpeta proceso contractual
            $(function() {
                $('#modalReiniciar').on("show.bs.modal", function (e) {
                    $("#modalReiniciarCdp").html($(e.relatedTarget).data('cdp'));
                    $("#modalReiniciarHref").attr('href', $(e.relatedTarget).data('href'));
                });
            });
            //Con este Script se envian los datos al modal Desertar proceso_contractual
            //El cual es llamado vista index.blade de la carpeta proceso contractual
            $(function() {
                $('#modalDesertar').on("show.bs.modal", function (e) {
                    $("#modalDesertarCdp").html($(e.relatedTarget).data('cdp'));
                    $("#modalDesertarHref").attr('href', $(e.relatedTarget).data('href'));
                });
            });
        });
    </script>
@endsection