<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Espacio para subir archivo</h3>
                </div>
                 {{  Form::open(['url'=> 'archivos',
                                  'method'=> 'post',
                                  'files'=>'true',
                                  'id' => 'my-dropzone' ,
                                  'class' => 'dropzone']) }}
                <div class="dz-message needsclick" style="height:200px;">
                    Drop your files here
                </div>
                <div class="dropzone-previews"></div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
