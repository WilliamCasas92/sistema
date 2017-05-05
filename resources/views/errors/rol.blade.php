@extends('master')
@section('errorrol')
    <div class="container col-md-12">
        <div class="alert alert-danger">
            <h1>Lo sentimos :(</h1><br>
            <h4>La dirección de correo electrónico no  cuenta con permisos para ingresar a SIGECOP.</h4>
            <h5>Comuníquese con el administrador del sistema para más información.</h5>
        </div>
        <a type="button" class="btn btn-danger" href="{{ url('desconexion') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="glyphicon glyphicon-chevron-left"></span> Salir
        </a>
        <form id="logout-form" action="{{ url('desconexion') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
@endsection