@extends('master')
@section('errorlogin')
    <div class="container col-md-12">
        <div class="alert alert-danger">
            <h1>Lo sentimos :(</h1><br>
            <h4>Usted no pudo ingresar a SIGECOP por las sigueintes razones:</h4>
            <ul>
                <li>Dirección de correo electrónico no registrada.</li>
                <li>Dirección de correo electrónico no pertenece al dominio.</li>
            </ul>
            <h5>Si el problema persiste comuníquese con el administrador del sistema.</h5>
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