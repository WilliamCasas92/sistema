@php
    $existen_datos=false;
@endphp
<div class="table-responsive">
    @if($etapa_activa=='Activo')
        <table class="table table-borderless table-tam">
    @else
        <table class="table table-condensed table-headborderless">
    @endif
        @if($etapa_activa!='Activo')
            <h5 class="text-info"><label>Información de Etapa</label></h5>
        @else
            <h5 class="text-info"><label>Diligencie los siguientes datos<br><br>Campos obligatorios (*)</label></h5>
        @endif
        <thead style="font-size : 11px;">
        <tr>
            <th class="text-center text-info" width="35%"></th>
            <th class="text-center" width="50%"></th>
        </tr>
        </thead>
        <tbody style="font-size : 11px;">
        <form id="FormEtapa{{$etapa->id}}" class="form-horizontal" method="post" action="/datosetapas">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="proceso_contractual_id" value="{{$proceso_contractual->id}}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @foreach ($requisitos as $requisito)
                @if ($requisito->etapas_id==$etapa->id)
                    @php
                        $existen_datos=true;
                        $tipo_req=\App\Http\Controllers\DatosEtapaController::imprimir_tipo_requisitos($requisito->tipo_requisitos_id);
                        $valor=\App\Http\Controllers\DatosEtapaController::busqueda_valor_dato_etapa($proceso_contractual->id, $requisito->id);
                        $required="";
                        $obligatorio="";
                        if ($requisito->obligatorio=='1'){
                            $required="required";
                            $obligatorio="(*)";
                        }
                        if($etapa_activa=='Activo'){
                            $requisito_activado='';
                            $checkbox_activado='';
                            $btn_activado='';
                        }else{
                            $requisito_activado='readonly';
                            $checkbox_activado='disabled';
                            $btn_activado='disabled';
                        }
                    @endphp
                    @if( $tipo_req == 'checkbox')
                        @if($etapa_activa=='Activo')
                            @php
                                if ($valor==1){
                                    $disabled='disabled';
                                }else{
                                    $disabled='';
                                }
                            @endphp
                            <input id="unchecked{{$requisito->id}}" type="hidden" name="atributo[]" value="0" {{$disabled}}>
                            <tr><div class="form-group">
                                <td class="text-right">
                                    <h5><label class="control-label" for="Input">{{$requisito->nombre}} {{$obligatorio}}:</label></h5>
                                </td>
                                    <div class="checkbox">
                                        <td><label><input {{$checkbox_activado}} id="checked{{$requisito->id}}" type="checkbox" {{ $valor==1 ? 'checked':''}} value="1" name="atributo[]" {{$required}}></label></td>
                                        <script>
                                            document.getElementById('checked{{$requisito->id}}').onchange = function() {
                                                document.getElementById('unchecked{{$requisito->id}}').disabled = this.checked;
                                            };
                                        </script>
                                    </div>
                            </div></tr>
                            <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
                        @else
                            <tr>
                                <td class="text-center" width="35%"><label>{{$requisito->nombre}}</label></td>
                                @if ($valor==1)
                                    <td width="35%">Si</td>
                                @else
                                    <td width="35%">No</td>
                                @endif
                            </tr>
                        @endif
                    @elseif ( $tipo_req == 'textarea' )
                            @if($etapa_activa=='Activo')
                            <tr><div class="form-group">
                                    <td class="text-right">
                                        <h5><label class="control-label " for="Input">{{$requisito->nombre}} {{$obligatorio}}:</label></h5></td>
                                        <td><textarea {{$requisito_activado}} rows="5" name="atributo[]" class="form-control" autocomplete="off" {{$required}}>{{$valor}}</textarea></td>
                                </div>
                            </tr>
                                <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
                            @else
                                <tr>
                                    <td class="text-center" width="35%"><label>{{$requisito->nombre}}</label></td>
                                    <td class="text-justify" width="35%">{{$valor}}</td>
                                </tr>
                            @endif
                    @elseif ($tipo_req == 'file')
                            @if($etapa_activa=='Activo')
                                <tr><div class="form-group">
                                        <td class="text-right">
                                            <h5><label class="control-label " for="Input">{{$requisito->nombre}} {{$obligatorio}}:</label></h5></td>
                                        <td> <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaladdDocumento"
                                                     data-idrequisito="{{$requisito->id}}"  data-idprocesocontractual="{{$proceso_contractual->id}}" >Subir Documento</button>
                                        </td>
                                    </div></tr>
                                <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
                            @else
                                <tr>
                                    @php
                                    $tipo=\App\Http\Controllers\DatosEtapaController::busqueda_tipo_dato_etapa($proceso_contractual->id, $requisito->id);
                                    @endphp
                                    <td class="text-center" width="35%"><label>{{$requisito->nombre}}</label></td>
                                    <td width="35%"><a href="/uploads/{{$valor}}-{{$requisito->id}}{{$proceso_contractual->id}}.{{$tipo}}" download="{{$valor}}">{{$valor}}</a></td>
                                </tr>
                            @endif
                        @else
                            @if($etapa_activa=='Activo')
                            <tr><div class="form-group">
                                    <td class="text-right">
                                        <h5><label class="control-label " for="Input">{{$requisito->nombre}} {{$obligatorio}}:</label></h5></td>
                                        @php
                                            $maxdate=date("Y-m-d");
                                            $mensajedate='max='.$maxdate.'';
                                            if($tipo_req!="date"){
                                                $mensajedate='';
                                            }
                                        @endphp
                                        <td><input {{$requisito_activado}} type="{{$tipo_req}}" name="atributo[]" {{$mensajedate}} class="form-control" value="{{$valor}}" autocomplete="off" {{$required}}></td>
                                </div></tr>
                                <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
                            @else
                                <tr>
                                    <td class="text-center" width="35%"><label>{{$requisito->nombre}}</label></td>
                                    <td width="35%">{{$valor}}</td>
                                </tr>
                            @endif
                    @endif
                @endif
            @endforeach
            @if ($existen_datos==true)
                <form class="form-inline">
                    <div align="center">
                        @if ($etapa_activa=='Activo')
                            <tr>
                                <td class="text-right" ><button id="btnGuardar{{$etapa->id}}" {{$btn_activado}} type="submit" class="btn btn-primary" formnovalidate>Guardar</button></td>
                                    @if($etapa->indice < count($etapas))
                                    <td><button type="button" {{$btn_activado}} class="btn btn-success" data-toggle="modal" data-target="#modalSave" data-url="{{ route('datosetapas.enviaretapa', array($proceso_contractual->id, $etapa->id)) }}"
                                            data-nombre="{{$etapa->nombre}}">Enviar a siguiente etapa </button></td>
                                @else
                                    <td><a {{$btn_activado}} href="" class="btn btn-danger">Finalizar</a><br></td>
                                @endif
                            </tr>
                        @endif
                    </div>
                </form>
                <script>
                    $(document).ready(function() {
                        // Interceptamos el evento submit del formulario agregar Etapa, Al fomulario eliminar Etapa
                        $('#FormEtapa{{$etapa->id}}').submit(function () {
                            // Enviamos el formulario usando AJAX
                            $.ajax({
                                type: 'POST',
                                url: $(this).attr('action'),
                                data: $(this).serialize(),
                                // Mostramos un mensaje con la respuesta de PHP
                                success: function (data) {
                                    alert("Los datos fuerón guardados con exito!")
                                }
                            }).fail(function (jqXHR, textStatus, errorThrown) {
                                alert('Los datos no se guardaron.');
                            });
                            return false;
                        });
                    });
                </script>
            @else
                <h3>No hay información por diligenciar.</h3>
            @endif
        </form>
        </tbody>
        @if($etapa_activa=='Activo')
            </table>
        @else
            </table>
        @endif
</div>

