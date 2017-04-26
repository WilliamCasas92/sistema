@extends('master')
@section('consultacontent')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><h2>Procesos de Contratación</h2></div>
            <div class="panel-body">
                <!-- Seccion para la busqueda-->
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse"  data-parent="#accordion" href="#collapseconsulta">
                                <h4><label class="text-info">Filtrar búsqueda de procesos
                                    <span class="glyphicon glyphicon-search"></span>
                                </label></h4>
                            </a>
                        </div>
                        <div id="collapseconsulta" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="well" name="FiltrosDeBusqueda">
                    <form class="form-horizontal" method="get" role="buscar" action="{{url('consultaproceso')}}">
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
                                <br><button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                            </div>
                        </form>
                    </form>
                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <th class="text-center">Estado</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <!-- Tabla de Indice de Procesos a diligenciar-->
                                @include('procesocontractual.index', compact($procesos_contractuales, $tipos_procesos))
                            </table>
                        @else
                            <h4 class="well" align="center">No existen procesos por consultar.</h4>
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