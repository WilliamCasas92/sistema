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
    <title>SIGECOP</title>
</head>
<header id="colorheader">
    <!-- Header Welcome -->
    <div class="container-fluid well-md headersize" id="colorheader">
        <div class="row">
            <div class="col-md-3">
                <a href="http://www.politecnicojic.edu.co/">
                    <img class="imglogo" src="{{asset('images/logo-institucion-300dpi-blanco-05.png')}}" width='360' height='75'>
                </a>
            </div>
            <div align="center" class="col-md-6">
                <h1 style="color:white;">SIGECOP</h1>
                <h3 style="color:white;">Sistema de Gestión para Procesos Contractuales del Poli</h3>
            </div>
            <div align="right">
                <div class="col-md-3" style="color:white;">
                    @if (Auth::check())
                    <h4>Bienvenido(a)</h4>
                    <h5>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h5>
                    <h5>{{ Auth::user()->email }}</h5>
                    <a type="button" class="btn btn-danger btn-xs" href="{{ url('desconexion') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-log-out"></span>
                        Salir
                    </a>
                    <form id="logout-form" action="{{ url('desconexion') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Header NavBar -->
    <nav class="navbar navbar-default navbarsize" id="estilonavbar">
        @if (Auth::check())
        <div align="center">
            <a href="{{ url('home') }}" type="button" class="btn btn-success">
                <span class="glyphicon glyphicon-home"></span> Inicio</a>
            @php
                $cont_tareas=0;
                $procesos_contractuales=\App\Http\Controllers\ProcesoContractualController::procesos_contractuales();
                foreach ($procesos_contractuales as $proceso_contractual){
                    $etapa_usuario=\App\Http\Controllers\ProcesoContractualController::etapa_usuario($proceso_contractual->estado, $proceso_contractual->tipo_procesos_id);
                    if(($etapa_usuario==true) && ($proceso_contractual->estado!='Finalizado')){
                        $cont_tareas++;
                    }
                }
            @endphp
            <a href="{{ url('consultaproceso') }}" type="button" class="btn btn-success">
                <span class="glyphicon glyphicon-search"></span> Procesos Contractuales
                @if ( (\Auth::user()->hasRol('Coordinador'))                          ||
                   (\Auth::user()->hasRol('Secretario técnico de dependencia'))    ||
                   (\Auth::user()->hasRol('Secretario'))                           ||
                   (\Auth::user()->hasRol('Abogado'))                              ||
                   (\Auth::user()->hasRol('Gestor de contratación'))               ||
                   (\Auth::user()->hasRol('Gestor de notificación'))               ||
                   (\Auth::user()->hasRol('Gestor de afiliación'))                 ||
                   (\Auth::user()->hasRol('Gestor de publicación'))                ||
                   (\Auth::user()->hasRol('Gestor de archivo'))                    )
                    <span class="badge">{{$cont_tareas}} pendientes</span>
                @endif
            </a>
            @if(Auth::user()->hasRol('Administrador'))
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-wrench"></span> Administración</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('usuarios') }}">
                                <span class="glyphicon glyphicon-user"></span> Gestión de Usuarios</a></li>
                        <li><a href="{{ url('tipoproceso') }}">
                                <span class="glyphicon glyphicon-lock"></span> Gestión de Tipos de Proceso de Contratación</a></li>
                        <li><a href="{{ url('indicadores') }}">
                                <span class="glyphicon glyphicon-stats"></span> Indicadores</a></li>
                    </ul>
                </div>
            @endif
            <a href="{{ url('acerca') }}" type="button" class="btn btn-success"><span class="glyphicon glyphicon-info-sign"></span> Acerca</a>
        </div>
        @endif
    </nav>
</header>
<body>
<!-- Vistas -->
    <div class="container-fluid panel-body">
        <div class="row">
            <div class="container margincontainer"><br>
                @yield("homecontent")
                @yield("errorlogin")
                @yield("errorrol")
                @yield("createuser")
                @yield("indexuser")
                @yield("edituser")
                @yield("createprocesstype")
                @yield("indexprocesstype")
                @yield("editprocesstype")
                @yield("createetapa")
                @yield("editetapa")
                @yield("createcontractualprocess")
                @yield("editcontractualprocess")
                @yield("checkprocess")
                @yield("consultacontent")
                @yield("showcontractcontent")
                @yield("indicators")
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
    <!--<script src="/js/jquery-3.1.1.js" type="text/javascript"></script>-->
    @yield('scriptEtapas')
    @yield('scriptEtapasShow')
    @yield('scriptMenu')
    @yield('scriptTipoProceso')
    @yield('scriptUsers')
    @yield('MyscriptsDiligenciar')
    @yield('scriptComites')
    @yield('scriptIndicador')
    @yield('scriptDatosEtapas')
    @yield('scriptconsultacontent')
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="text-muted text-center">
                Politécnico Colombiano Jaime Isaza Cadavid © {{date("Y")}}
                Carrera 48 # 7-151 El Poblado, Medellín - PBX: 3197900</p>
        </div>
    </footer>
</body>
</html>