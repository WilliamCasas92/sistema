@extends('master')
@section('homecontent')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><label style="font-size : 25px;">Bienvenido(a) a SIGECOP</label></div>
            <div class="panel-body">
                <div class="container-fluid text-center">
                    <div class="row">
                        <div class="col-md-8">
                            @if(\Auth::user()->hasRol('Usuario general'))
                                <div class="panel panel-success">
                                    <div class="panel-body">
                                        <p>Para consultar información acerca de los procesos contractuales,
                                            presiona clic en la opción <span class="label label-success">
                                                <span class="glyphicon glyphicon-search"></span> Procesos Contractuales</span>
                                            y luego presiona clic en <span class="label label-info"> Ver más</span>.</p>
                                    </div>
                                </div>
                            @else
                                @include('home.procesoshome')
                            @endif
                        </div>
                        <div class="col-md-4">
                            @include('home.datoshome')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
