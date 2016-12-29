<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <!-- Styles -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <title>Sistema Contratación</title>
</head>
<header>
    <!-- Header Welcome -->
    <div class="container-fluid well-sm" style="background-color:rgb(159, 178, 82);">
        <div class="row">
            <div class="col-md-3">
                <img src="{{asset('images/logo-institucion-300dpi-blanco-05.png')}}" width='350' height='70'>
            </div>
            <div align="center" class="col-md-6">
                <h1>Sistema de gestión para procesos contractuales</h1>
            </div>
            <div align="left">
                <div class="col-md-2">
                    <h4>Conectado como</h4>
                    <h5>{{ Auth::user()->email }}</h5>
                    <h5>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h5>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ Auth::logout() }}" class="btn btn-lg">
                                <span class="glyphicon "></span> Salir </a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!-- Header NavBar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid" style="background-color:rgb(25, 104, 68);">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('home') }}" class="btn btn-lg">
                        <span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="#" class="btn btn-lg" >
                        <span class="glyphicon glyphicon-info-sign"></span> Acerca</a></li>
            </ul>
        </div>
    </nav>
</header>
<body>
<!-- Vistas -->
<div class="panel-body">
    <div class="row">
        <div class="col-md-2 navbar">
            <div class="list-group">
                <li class="list-group-item"><h2>
                        <span class="glyphicon glyphicon-menu-hamburger"></span>Opciones</h2></li>
                <a href="{{ url('') }}" class="list-group-item list-group-item-success active">
                    <span class=""></span> Opción 1</a>
                <a href="{{ url('') }}" class="list-group-item list-group-item-success">
                    <span class=""></span> Opción 2</a>
                <a href="{{ url('') }}" class="list-group-item list-group-item-success">
                    <span class=""></span> Opción 3</a>
            </div>
        </div>
        <div class="col-md-10">
            @yield("homecontent")
            @yield("createuser")
            @yield("indexuser")
            @yield("edituser")
        </div>
    </div>
</div>
<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
<!-- Footer -->
<footer class="footer container-fluid text-center">
    <div class="panel-footer">
        <p class="text-muted">
            Politécnico Colombiano Jaime Isaza Cadavid © 2016
            Carrera 48 # 7-151 El Poblado, Medellín - PBX: 3197900
        </p>
    </div>
</footer>
</html>
