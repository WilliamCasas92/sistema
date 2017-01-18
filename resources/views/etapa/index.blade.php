<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse<?php echo $data->id ?>">{{ $data->nombre }}</a>
        </h4>
    </div>
    <div id="collapse<?php echo $data->id ?>" class="panel-collapse collapse">
        <div class="panel-body">
            <input type="button" value="Añadir Dato" class="btn btn-success"><br>Aca va la lista de datos<br>
            <input type="button" value="Añadir Dato Predeterminado" class="btn btn-success"><br>Aca va la lista de datos predeterminados<br>
            <input type="button" value="Añadir Dato CheckBox" class="btn btn-success"><br>Aca va la lista de datos checkbox<br>
        </div>
    </div>
</div>