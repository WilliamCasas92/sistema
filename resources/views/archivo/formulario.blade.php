@extends('master')
@section('contenido')
    <script src="/js/dropzone.js" type="text/javascript"></script>
    <link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
    <script>
        /**
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 2,

            init: function() {
                var submitBtn = document.querySelector("#submit");
                myDropzone = this;

                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on("addedfile", function(file) {
                    alert("file uploaded");
                });

                this.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });

                this.on("success",
                    myDropzone.processQueue.bind(myDropzone)
                );
            }
        };
        **/
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Espacio para subir archivo</h3>
                    </div>
                    {!! Form::open(['url'=> 'archivos',
                                    'method'=> 'post',
                                    'files'=>'true',
                                    'id' => 'my-dropzone' ,
                                    'class' => 'dropzone']) !!}
                    <div class="dz-message needsclick" style="height:200px;">
                        Drop your files here
                    </div>
                    <div class="dropzone-previews"></div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
        <div>
            <table class="table table-bordered">
                <thead>
                    <th>ID</th>
                    <th>nombre</th>
                    <th>tipo</th>
                    <th>tamaño</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($descargas as $descarga)
                        <tr>
                            <td>{{$descarga->id}}</td>
                            <td>{{$descarga->nombre}}</td>
                            <td>{{$descarga->tipo}}</td>
                            <td>{{$descarga->tamaño}}</td>
                            <td><a href="/uploads/{{$descarga->nombre}}.{{$descarga->tipo}}" download>Descargar</a>
                                <br>
                                <form action="{{ route('archivos.destroy', $descarga->id) }}"  method="POST">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                                    <button id="eliminar" type="submit" class="btn btn-danger" >Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection