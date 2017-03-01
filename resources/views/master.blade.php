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
<header id="colorheader">
    <!-- Header Welcome -->
    <div class="container-fluid well-md headersize" id="colorheader">
        <div class="row">
            <div class="col-md-3">
                <img class="imglogo" src="{{asset('images/logo-institucion-300dpi-blanco-05.png')}}" width='360' height='75'>
            </div>
            <div align="center" class="col-md-6">
                <h1 style="color:white;">Sistema de gestión para procesos contractuales</h1>
            </div>
            <div align="right">
                <div class="col-md-3" style="color:white;">
                    <h4>Bienvenido(a)</h4>
                    <h5>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h5>
                    <h5>{{ Auth::user()->email }}</h5>
                    <a type="button" class="btn btn-danger btn-xs" href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-log-out"></span>
                        Salir
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Header NavBar -->
    <nav class="navbar navbar-default navbarsize" id="estilonavbar">
        <div align="center">
            <a href="{{ url('home') }}" type="button" class="btn btn-success">
                <span class="glyphicon glyphicon-home"></span> Inicio</a>
            <a href="{{ url('consultaproceso') }}" type="button" class="btn btn-success">
                <span class="glyphicon glyphicon-search"></span> Consultar procesos</a>
            <a href="{{ url('procesocontractual') }}" type="button" class="btn btn-success">
                <span class="glyphicon glyphicon-edit"></span> Diligenciar información de proceso</a>
            @if(Auth::user()->hasRol('Administrador'))
                <div class="btn-group">
                    <button type="button" class="btn btn-success">
                        <span class="glyphicon glyphicon-wrench"></span> Administración</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('users') }}">
                                <span class="glyphicon glyphicon-user"></span> Gestión de Usuarios</a></li>
                        <li><a href="{{ url('tipoproceso') }}">
                                <span class="glyphicon glyphicon-lock"></span> Gestión de Tipos de Proceso de Contratación</a></li>
                    </ul>
                </div>
            @endif
            <a href="{{ url('about') }}" type="button" class="btn btn-success disabled"><span class="glyphicon glyphicon-info-sign"></span> Acerca</a>
        </div>
    </nav>
</header>
<body>
<!-- Vistas -->
    <div class="container-fluid panel-body">
        <div class="row">
            <div class="container margincontainer">
                @yield("homecontent")
                @yield("createuser")
                @yield("indexuser")
                @yield("edituser")
                @yield("createprocesstype")
                @yield("indexprocesstype")
                @yield("editprocesstype")
                @yield("createetapa")
                @yield("editetapa")
                @yield("indexcontractualprocess")
                @yield("createcontractualprocess")
                @yield("editcontractualprocess")
                @yield("checkprocess")
                @yield("consultacontent")
                @yield("showcontractcontent")
                @yield('contenido')
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
    <!--<script src="/js/jquery-3.1.1.js" type="text/javascript"></script>-->
    @yield('scriptEtapas')
    @yield('scriptMenu')
    @yield('scriptTipoProceso')
    @yield('scriptUsers')
    @yield('MyscriptsDiligenciar')
    @yield('scriptComites')
<br>
    <!-- Footer -->
    <footer class="footer text-center">
        <div class="panel-footer">
            <p class="text-muted">
                Politécnico Colombiano Jaime Isaza Cadavid © {{date("Y")}}
                Carrera 48 # 7-151 El Poblado, Medellín - PBX: 3197900
            </p>
        </div>
    </footer>
</body>
</html>