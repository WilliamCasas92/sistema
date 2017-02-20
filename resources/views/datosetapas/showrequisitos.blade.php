@php
    $existen_datos=false;
@endphp
<h4>Diligencie los siguientes datos: </h4>
Campos obligatorios (*)<br><br>
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
                    //cuando se vaya a pasar de etapa, se activa el required
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
                @php
                    if ($valor==1){
                        $disabled='disabled';
                    }else{
                        $disabled='';
                    }
                @endphp
                <input id="unchecked{{$requisito->id}}" type="hidden" name="atributo[]" value="0" {{$disabled}}>
                <div class="form-group">
                    <label class="control-label col-md-5" for="Input">{{$requisito->nombre}} {{$obligatorio}}:</label>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label><input {{$checkbox_activado}} id="checked{{$requisito->id}}" type="checkbox" {{ $valor==1 ? 'checked':''}} value="1" name="atributo[]" {{$required}}></label>
                            <script>
                                document.getElementById('checked{{$requisito->id}}').onchange = function() {
                                    document.getElementById('unchecked{{$requisito->id}}').disabled = this.checked;
                                };
                            </script>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
            @elseif ( $tipo_req == 'textarea' )
                <div class="form-group">
                    <label class="control-label col-md-5" for="Input">{{$requisito->nombre}} {{$obligatorio}}: </label>
                    <div class="col-md-4">
                        <textarea {{$requisito_activado}} rows="6" name="atributo[]" class="form-control" autocomplete="off" {{$required}}>{{$valor}}</textarea>
                    </div>
                </div>
                <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
                @else
                    <div class="form-group">
                        <label class="control-label col-md-5" for="Input">{{$requisito->nombre}} {{$obligatorio}}: </label>
                        <div class="col-md-4">
                            <input {{$requisito_activado}} type="{{$tipo_req}}" name="atributo[]" class="form-control" value="{{$valor}}" autocomplete="off" {{$required}}>
                        </div>
                    </div>
                    <input type="hidden" name="requisito_id[]" value="{{$requisito->id}}">
            @endif
        @endif
    @endforeach
    @if ($existen_datos==true)
        <form class="form-inline">
            <div align="center">
                @if ($etapa_activa=='Activo')
                    <button id="btnGuardar{{$etapa->id}}" {{$btn_activado}} type="submit" class="btn btn-primary" formnovalidate>Guardar</button>
                    @if($etapa->indice < count($etapas))
                        <a id="btnEnviar{{$etapa->id}}" href="{{ route('datosetapas.enviaretapa', array($proceso_contractual->id, $etapa->id, Auth::user()->id)) }}" {{$btn_activado}} class="btn btn-success">Enviar a siguiente etapa</a>

                        <button type="button" {{$btn_activado}} class="btn btn-success" data-toggle="modal" data-target="#modalSave" data-url="{{ route('datosetapas.enviaretapa', array($proceso_contractual->id, $etapa->id, Auth::user()->id)) }}"
                          data-nombre="{{$etapa->nombre}}">Enviar a siguiente etapa </button>
                    @else
                        <a {{$btn_activado}} href="" class="btn btn-danger"> Finalizar</a><br>
                    @endif
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
                        alert('La etapa no se puede eliminar porque tiene requisitos asociados');
                    });
                    return false;
                });
            });
        </script>
    @else
        <h3>No hay información por diligenciar.</h3>
    @endif
</form>

