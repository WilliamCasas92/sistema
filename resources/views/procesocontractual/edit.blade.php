@extends('master')
@section('editcontractualprocess')
    <div class="container col-md-12">
        <div class="panel panel-success">
            @if(Auth::user()->hasRol('Gestor de contratación'))
                <div class="panel-heading"><label style="font-size : 20px;">Asigne número de contrato</label></div>
            @else
                <div class="panel-heading"><label style="font-size : 20px;">Editar Proceso de Contratación</label></div>
            @endif
            @php
                if(Auth::user()->hasRol('Gestor de contratación')){
                    $readonly='readonly';
                    $disabled='disabled';
                }else{
                    $readonly='';
                    $disabled='';
                    $disabledcheckbox='';
                }
            @endphp
            <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="form-horizontal" method="post" action="/procesocontractual/{{$proceso_contractual->id}}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputTipoProceso">Tipo de Proceso de Contratación: </label>
                        <div class="col-md-5">
                            <input type="text" name="tipo_proceso" readonly="readonly" class="form-control" value="{{$proceso_contractual->tipo_proceso}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputCDP">Número de CDP: </label>
                        <div class="col-md-3">
                            <input type="text" name="num_cdp" {{$readonly}} class="form-control" autocomplete="off" placeholder="Digite el número de CDP" value="{{$proceso_contractual->numero_cdp}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputYearCDP">Año CDP: </label>
                        <div class="col-md-3">
                            <input type="text" name="year_cdp" {{$readonly}} class="form-control" autocomplete="off" placeholder="Año de expedición del CDP" value="{{$proceso_contractual->year_cdp}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputObjeto">Objeto: </label>
                        <div class="col-md-5">
                            <textarea rows="6" name="objeto" {{$readonly}} class="form-control" autocomplete="off" required>{{$proceso_contractual->objeto}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputValor">Valor del contrato: </label>
                        <div class="col-md-3">
                            <input type="number" name="num_valor" {{$readonly}} class="form-control" autocomplete="off" min="1" step="1" placeholder="Digite el valor del contrato" value="{{$proceso_contractual->valor}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputValor">Plazo de ejecución: </label>
                        <div class="col-md-5">
                            <input type="number" name="num_plazo" {{$readonly}} class="form-control" autocomplete="off" min="1" step="1" placeholder="Digite el número de días de ejecución del contrato" value="{{$proceso_contractual->plazo}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputDependencia">Depedencia: </label>
                        <div class="col-md-5">
                            <select  class="form-control" name="dependencia" {{$readonly}} id="dependencia" required>
                                @if ($proceso_contractual->dependencia=='Rectoría')
                                    <option  selected value="{{$proceso_contractual->dependencia}}">{{$proceso_contractual->dependencia}}</option>
                                    <option value="Vicerrectoría de Docencia e Investigación">Vicerrectoría de Docencia e Investigación</option>
                                    <option value="Vicerrectoría de Extensión">Vicerrectoría de Extensión</option>
                                    <option value="Vicerrectoría Administrativa">Vicerrectoría Administrativa</option>
                                @endif
                                @if($proceso_contractual->dependencia=='Vicerrectoría de Docencia e Investigación')
                                    <option value="Rectoria">Rectoría</option>
                                    <option selected value="{{$proceso_contractual->dependencia}}">{{$proceso_contractual->dependencia}}</option>
                                    <option value="Vicerrectoría de Extensión">Vicerrectoría de Extensión</option>
                                    <option  value="Vicerrectoría Administrativa">Vicerrectoría Administrativa</option>
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
                            <label class="control-label col-md-4" for="InputNumContrato">Número de Contrato: </label>
                            <div class="col-md-3">
                                <input type="text" name="num_contrato" class="form-control" autocomplete="off" placeholder="Digite el número de contrato" >
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label class="control-label col-md-4" for="InputNumContrato">Número de Contrato: </label>
                            <div class="col-md-3">
                                <input type="text" name="num_contrato" class="form-control" autocomplete="off" placeholder="Digite el número de contrato" value="{{$proceso_contractual->numero_contrato}}" >
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputSupervisor">Nombre del Supervisor: </label>
                        <div class="col-md-5">
                            <input type="text" name="nombre_supervisor" {{$readonly}} class="form-control" autocomplete="off" placeholder="Digite el nombre del supervisor" value="{{$proceso_contractual->nombre_supervisor}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputIDSupervisor">Identificación del Supervisor: </label>
                        <div class="col-md-3">
                            <input type="text" name="id_supervisor" {{$readonly}} class="form-control" autocomplete="off" placeholder="Digite identificación del supervisor" value="{{$proceso_contractual->id_supervisor}}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputEmailSupervisor">Email del Supervisor: </label>
                        <div class="col-md-5">
                            <input type="email" name="email_supervisor" {{$readonly}} class="form-control" autocomplete="off" placeholder="Digite el email del supervisor" value="{{$proceso_contractual->email_supervisor}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputRoles">Comités participes:</label><br>
                        <div class="col-md-8">
                            <div class="checkbox">
                                <label><input id="comite_docenciainv" type="checkbox" {{ $proceso_contractual->comiteinterno=='1' ? 'checked':''}} name="comite_docenciainv" value="1" required>Comité Interno de Docencia e Investigación</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_extension" type="checkbox" {{ $proceso_contractual->comiteinterno=='2' ? 'checked':''}} name="comite_extension" value="2" required>Comité Interno de Extensión</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_admin" type="checkbox" {{ $proceso_contractual->comiteinterno=='3' ? 'checked':''}} name="comite_admin" value="3" required>Comité Interno de Administración</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_rectoria" type="checkbox" {{ $proceso_contractual->comiterectoria ? 'checked':''}} name="comite_rectoria" value="4" required>Comité Interno de Rectoría</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_asesor" type="checkbox" {{ $proceso_contractual->comiteasesor ? 'checked':''}} name="comite_asesor" value="5">Comité Asesor de Contratación</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_ev" type="checkbox" {{ $proceso_contractual->comiteevaluador ? 'checked':''}} name="comite_ev" value="6">Comité Evaluador</label>
                            </div>
                        </div>
                    </div><br>
                    <!-- Fechas Comités-->
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha de reunión de Comité Interno: </label>
                        <div class="col-md-3">
                            <input id="comitecheck1" type="text" name="date_aprobación1" {{$readonly}} class="form-control datepicker" value="{{$proceso_contractual->fecha_comiteinterno}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha de reunión de Comité Interno de Rectoría: </label>
                        <div class="col-md-3">
                            <input id="comitecheck2" type="text" name="date_aprobación2" {{$readonly}} class="form-control datepicker" value="{{$proceso_contractual->fecha_comiterectoria}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha de reunión de Comité Asesor de Contratación:</label>
                        <div class="col-md-3">
                            <input id="comitecheck3" type="text" name="date_aprobación3" {{$readonly}} class="form-control datepicker" value="{{$proceso_contractual->fecha_comiteasesor}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha de reunión de Comité Evaluador:</label>
                        <div class="col-md-3">
                            <input id="comitecheck4" type="text" name="date_aprobación4" {{$readonly}} class="form-control datepicker" value="{{$proceso_contractual->fecha_comiteevaluador}}" disabled>
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
        <h4><a class="btn btn-default" href="{{route('consulta.mostrar')}}"><span class="glyphicon glyphicon-chevron-left"></span> Ir atrás</a></h4>
    </div>
    <script>
        $('.datepicker').datepicker({
            todayBtn: "linked",
            clearBtn: true,
            language: "es",
            endDate: "today",
            autoclose: true
        });
    </script>
@endsection
@section('scriptComites')
    @if(Auth::user()->hasRol('Gestor de contratación'))
        <script>
            $(document).ready(function() {
                $('option:not(:selected)').attr('disabled', true);

                $( '#comite_docenciainv' ).click( function( e ) {
                    e.preventDefault();
                    return false;
                } );
                $( '#comite_extension' ).click( function( e ) {
                    e.preventDefault();
                    return false;
                } );
                $( '#comite_admin' ).click( function( e ) {
                    e.preventDefault();
                    return false;
                } );
                $( '#comite_rectoria' ).click( function( e ) {
                    e.preventDefault();
                    return false;
                } );
                $( '#comite_asesor' ).click( function( e ) {
                    e.preventDefault();
                    return false;
                } );
                $( '#comite_ev' ).click( function( e ) {
                    e.preventDefault();
                    return false;
                } );
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            if(document.getElementById('comite_docenciainv').checked) {
                $('#comite_rectoria').attr("required",false);
                $('#comite_extension').attr("disabled",true);
                $('#comite_admin').attr("disabled",true);
                $('#comitecheck1').attr("disabled",false);
            }
            if(document.getElementById('comite_extension').checked) {
                $('#comite_rectoria').attr("required",false);
                $('#comite_docenciainv').attr("disabled",true);
                $('#comite_admin').attr("disabled",true);
                $('#comitecheck1').attr("disabled",false);
            }
            if(document.getElementById('comite_admin').checked) {
                $('#comite_rectoria').attr("required",false);
                $('#comite_extension').attr("disabled",true);
                $('#comite_docenciainv').attr("disabled",true);
                $('#comitecheck1').attr("disabled",false);
            }
            if(document.getElementById('comite_rectoria').checked) {
                $('#comite_docenciainv').attr("required",false);
                $('#comite_extension').attr("required",false);
                $('#comite_admin').attr("required",false);
                $('#comitecheck2').attr("disabled",false);
            }
            if(document.getElementById('comite_asesor').checked) {
                $('#comitecheck3').attr("disabled",false);
            }
            if(document.getElementById('comite_ev').checked) {
                $('#comitecheck4').attr("disabled",false);
            }
            document.getElementById('comite_docenciainv').onchange = function() {
                document.getElementById('comitecheck1').disabled = !this.checked;
                $('#comitecheck1').attr("required",true);
                $('#comite_rectoria').attr("required",false);
                document.getElementById('comite_extension').disabled = this.checked;
                document.getElementById('comite_admin').disabled = this.checked;
            };
            document.getElementById('comite_extension').onchange = function() {
                document.getElementById('comitecheck1').disabled = !this.checked;
                $('#comitecheck1').attr("required",true);
                $('#comite_rectoria').attr("required",false);
                document.getElementById('comite_docenciainv').disabled = this.checked;
                document.getElementById('comite_admin').disabled = this.checked;
            };
            document.getElementById('comite_admin').onchange = function() {
                document.getElementById('comitecheck1').disabled = !this.checked;
                $('#comitecheck1').attr("required",true);
                $('#comite_rectoria').attr("required",false);
                document.getElementById('comite_extension').disabled = this.checked;
                document.getElementById('comite_docenciainv').disabled = this.checked;
            };
            document.getElementById('comite_rectoria').onchange = function() {
                document.getElementById('comitecheck2').disabled = !this.checked;
                $('#comite_docenciainv').attr("required",false);
                $('#comite_extension').attr("required",false);
                $('#comite_admin').attr("required",false);
                $('#comitecheck2').attr("required",true);
            };
            document.getElementById('comite_asesor').onchange = function() {
                document.getElementById('comitecheck3').disabled = !this.checked;
                $('#comitecheck3').attr("required",true);
            };
            document.getElementById('comite_ev').onchange = function() {
                document.getElementById('comitecheck4').disabled = !this.checked;
                $('#comitecheck4').attr("required",true);
            };
        })
    </script>
@endsection

