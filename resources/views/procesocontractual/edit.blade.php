@extends('master')
@section('editcontractualprocess')
    <div class="container col-md-9">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Editar Proceso de Contratación</h3></div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="/procesocontractual/{{$proceso_contractual->id}}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Tipo de Proceso: </label>
                        <div class="col-md-5">
                            <input type="text" name="tipo_proceso" class="form-control" autocomplete="off" placeholder="Seleccione el tipo de proceso de contratación" value="{{$proceso_contractual->tipo_proceso}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Número de CDP: </label>
                        <div class="col-md-3">
                            <input type="text" name="num_cdp" class="form-control" autocomplete="off" placeholder="Digite el número de CDP" value="{{$proceso_contractual->numero_cdp}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Objeto: </label>
                        <div class="col-md-5">
                            <textarea rows="6" name="objeto" class="form-control" autocomplete="off" required>{{$proceso_contractual->objeto}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Depedencia: </label>
                        <div class="col-md-5">
                            <select class="form-control" name="dependencia" id="dependencia" required>
                                @if ($proceso_contractual->dependencia=='Rectoría')
                                    <option selected value="{{$proceso_contractual->dependencia}}">{{$proceso_contractual->dependencia}}</option>
                                    <option value="Vicerrectoría de Docencia e Investigación">Vicerrectoría de Docencia e Investigación</option>
                                    <option value="Vicerrectoría de Extensión">Vicerrectoría de Extensión</option>
                                    <option value="Vicerrectoría Administrativa">Vicerrectoría Administrativa</option>
                                @endif
                                @if($proceso_contractual->dependencia=='Vicerrectoría de Docencia e Investigación')
                                    <option value="Rectoria">Rectoría</option>
                                    <option selected value="{{$proceso_contractual->dependencia}}">{{$proceso_contractual->dependencia}}</option>
                                    <option value="Vicerrectoría de Extensión">Vicerrectoría de Extensión</option>
                                    <option value="Vicerrectoría Administrativa">Vicerrectoría Administrativa</option>
                                @endif
                                @if($proceso_contractual->dependencia=='Vicerrectoría de Extensión')
                                    <option value="Rectoria">Rectoría</option>
                                    <option value="Vicerrectoría de Docencia e Investigación">Vicerrectoría de Docencia e Investigación</option>
                                    <option selected value="{{$proceso_contractual->dependencia}}">{{$proceso_contractual->dependencia}}</option>
                                    <option value="Vicerrectoría Administrativa">Vicerrectoría Administrativa</option>
                                @endif
                                @if($proceso_contractual->dependencia=='Vicerrectoría Administrativa')
                                    <option value="Rectoria">Rectoría</option>
                                    <option value="Vicerrectoría de Docencia e Investigación">Vicerrectoría de Docencia e Investigación</option>
                                    <option value="Vicerrectoría de Extensión">Vicerrectoría de Extensión</option>
                                    <option selected value="{{$proceso_contractual->dependencia}}">{{$proceso_contractual->dependencia}}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    @if ($proceso_contractual->numero_contrato==null)
                        <div class="form-group">
                            <label class="control-label col-md-4" for="InputName">Número de Contrato: </label>
                            <div class="col-md-3">
                                <input type="text" name="num_contrato" class="form-control" autocomplete="off" placeholder="Digite el número de contrato" >
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label class="control-label col-md-4" for="InputName">Número de Contrato: </label>
                            <div class="col-md-3">
                                <input type="text" name="num_contrato" class="form-control" autocomplete="off" placeholder="Digite el número de contrato" value="{{$proceso_contractual->numero_contrato}}" >
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Fecha de Aprobación: </label>
                        <div class="col-md-3">
                            <input type="date" name="date_aprobación" class="form-control" autocomplete="off" value="{{$proceso_contractual->fecha_aprobacion}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombre del Supervisor: </label>
                        <div class="col-md-5">
                            <input type="text" name="nombre_supervisor" class="form-control" autocomplete="off" placeholder="Digite el nombre del supervisor" value="{{$proceso_contractual->nombre_supervisor}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Identificación del Supervisor: </label>
                        <div class="col-md-3">
                            <input type="text" name="id_supervisor" class="form-control" autocomplete="off" placeholder="Digite C.C. del supervisor" value="{{$proceso_contractual->id_supervisor}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Email del Supervisor: </label>
                        <div class="col-md-5">
                            <input type="email" name="email_supervisor" class="form-control" autocomplete="off" placeholder="Digite el email del supervisor" value="{{$proceso_contractual->email_supervisor}}">
                        </div>
                    </div>
                    <form class="form-inline">
                        <div align="center">
                            <br><button type="submit" class="btn btn-default">Actualizar</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('procesocontractual.index')}}">Volver a la lista de Tipos de Procesos</a></h4>
    </div>
@endsection