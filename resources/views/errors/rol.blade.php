<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/estilo.css')}}" rel="stylesheet">
    @include('estilogeneral')
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="/js/jquery-3.1.1.js" type="text/javascript"></script>
    <link rel="icon" type="image/gif/png" href="{{asset('images/logo-institucion.png')}}">
    <title>Sistema Contratación</title>
</head>
<body>
<br>
<div class="container">
    <div class="alert alert-danger">
        <h1>Lo sentimos :(</h1><br>
        <h4>La dirección de correo electrónico no  cuenta con permisos para ingresar a SIGECOP.</h4>
        <h5>Comuniquese con el administrador del sistema para más información.</h5>
    </div>
    <a type="button" class="btn btn-danger" href="{{ url('/logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver a ingresar
    </a>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>
</body>
</html>