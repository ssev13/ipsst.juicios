<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de seguimiento de Juicios de Asesoría Letrada del I.P.S.S.T.</title>

    <!-- Bootstrap Core CSS
    <link href="css/bootstrap.min.css" rel="stylesheet">
     -->
    {!! Html::style("/css/bootstrap.min.css") !!}

    <!-- Custom CSS
    <link href="css/sb-admin.css" rel="stylesheet">
     -->
    {!! Html::style("/css/sb-admin.css") !!}

    <!-- Morris Charts CSS 
    <link href="css/plugins/morris.css" rel="stylesheet">
     -->
    {!! Html::style("/css/plugins/morris.css") !!}

    <!-- Custom Fonts 
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     -->
    {!! Html::style("/font-awesome/css/font-awesome.min.css") !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('header')

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('juicios.panel') }}">
                    <img width="15%" src="{{ asset('img/logo1.gif') }}">
                </a>
            </div>
            <!-- Top Menu Items -->

            @include('layouts.usuario')

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="{{ route('juicios.panel') }}"><i class="fa fa-fw fa-dashboard"></i> Panel de Control</a>
                    </li>
					<li>
                        <a href="{{ route('juicios.create') }}"><i class="fa fa-fw fa-edit"></i> Alta de Juicios</a>
                    </li>
                    <li>
                        <a href="{{ route('juicios.list', 'null') }}"><i class="fa fa-fw fa-table"></i> Listado de Juicios</a>
                    </li>
                    <li>
                        <a href="{{ route('juicios.report') }}"><i class="fa fa-fw fa-bar-chart-o"></i> Reportes</a>
                    </li>
                    <li>
                        <a href="{{ route('juicios.list_trashed') }}"><i class="fa fa-fw fa-trash"></i> Juicios Cerrados</a>
                    </li>
                    <li>
                        <a href="{{ route('juicios.stats') }}"><i class="fa fa-fw fa-signal"></i> Estadísticas</a>
                    </li>
                    <li>
                        <a href="{{ route('juicios.help') }}"><i class="glyphicon glyphicon-question-sign"></i> Ayuda</a>
                    </li>
					<!--
                    <li>
                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li>
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>
                    <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        @yield('content')

    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    @yield('scripts')

</body>

</html>
