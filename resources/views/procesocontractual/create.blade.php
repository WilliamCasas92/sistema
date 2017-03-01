@extends('master')
@section('createcontractualprocess')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Crear nuevo proceso de contratación</h3></div>
            <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="form-horizontal" method="post" action="/procesocontractual">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Tipo de Proceso de Contratación: </label>
                        <div class="col-md-5">
                            <select class="form-control" name="tipo_proceso" id="tipo_proceso" required>
                                @foreach($tipos_procesos as $tipo_proceso)
                                    <option value="{{$tipo_proceso->nombre}}">{{$tipo_proceso->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputNumCDP">CDP: </label>
                        <div class="col-md-3">
                            <input type="text" name="num_cdp" class="form-control" autocomplete="off" placeholder="Digite el número de CDP" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputObjeto">Objeto: </label>
                        <div class="col-md-5">
                            <textarea rows="6" name="objeto" class="form-control" autocomplete="off" placeholder="Digite el objeto del contrato" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputValor">Valor del contrato: </label>
                        <div class="col-md-3">
                            <input type="number" name="num_valor" class="form-control" autocomplete="off" min="0" step="1" placeholder="Digite el valor del contrato" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputValor">Plazo de ejecución: </label>
                        <div class="col-md-5">
                            <input type="number" name="num_plazo" class="form-control" autocomplete="off" min="1" step="1" placeholder="Digite el número de días de ejecución del contrato" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputDependencia">Depedencia: </label>
                        <div class="col-md-5">
                            <select class="form-control" name="dependencia" id="dependencia" required>
                                <option value="Rectoría">Rectoría</option>
                                <option value="Vicerrectoría de Docencia e Investigación">Vicerrectoría de Docencia e Investigación</option>
                                <option value="Vicerrectoría de Extensión">Vicerrectoría de Extensión</option>
                                <option value="Vicerrectoría Administrativa">Vicerrectoría Administrativa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputNameSupervisor">Nombre del Supervisor: </label>
                        <div class="col-md-5">
                            <input type="text" name="nombre_supervisor" class="form-control" autocomplete="off" placeholder="Digite el nombre del supervisor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputIDSupervisor">Identificación del Supervisor: </label>
                        <div class="col-md-3">
                            <input type="text" name="id_supervisor" class="form-control" autocomplete="off" placeholder="Digite identificación del supervisor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputEmailSupervisor">Email del Supervisor: </label>
                        <div class="col-md-5">
                            <input type="email" name="email_supervisor" class="form-control" autocomplete="off" placeholder="Digite el email del supervisor">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputRoles">Comités participes:</label><br>
                        <div class="col-md-8">
                            <div class="checkbox">
                                <label><input id="comite_docenciainv" type="checkbox" name="comite_docenciainv" value="1" required>Comité Interno de Docencia e Investigación</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_extension" type="checkbox" name="comite_extension" value="2" required>Comité Interno de Extensión</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_admin" type="checkbox" name="comite_admin" value="3" required>Comité Interno de Administración</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_rectoria" type="checkbox" name="comite_rectoria" value="4" required>Comité Interno de Rectoría</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_asesor" type="checkbox" name="comite_asesor" value="5">Comité Asesor de Contratación</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="comite_ev" type="checkbox" name="comite_ev" value="6">Comité Evaluador</label>
                            </div>
                        </div>
                    </div><br>

                    <!-- Fechas Comités-->
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha de reunión de Comité Interno: </label>
                        <div class="col-md-3">
                            <input id="comitecheck1" type="date" name="date_aprobación1" max="{{date("Y-m-d")}}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha de reunión de Comité Interno de Rectoría: </label>
                        <div class="col-md-3">
                            <input id="comitecheck2" type="date" name="date_aprobación2" max="{{date("Y-m-d")}}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha de reunión de Comité Asesor de Contratación:</label>
                        <div class="col-md-3">
                            <input id="comitecheck3" type="date" name="date_aprobación3" max="{{date("Y-m-d")}}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Fecha de reunión de Comité Evaluador:</label>
                        <div class="col-md-3">
                            <input id="comitecheck4" type="date" name="date_aprobación4" max="{{date("Y-m-d")}}" class="form-control" disabled>
                        </div>
                    </div>
                    <form class="form-inline">
                        <div align="center">
                            <br><button type="submit" class="btn btn-default">Crear Proceso de Contratación</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('procesocontractual.index')}}">Volver a la lista de Procesos Contractuales</a></h4>
    </div>
@endsection
@section('scriptComites')
    <script>
        $(document).ready(function() {
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

