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
                <a class="navbar-brand" href="{{ route('juicios.panel') }}">
                    <img width="15%" src="{{ asset('img/logo1.gif') }}">                    
                </a>
            </div>

             @include('layouts.usuario')

            <!-- /.navbar-collapse -->
        </nav>

        @yield('content')

    </div>
    <!-- /#wrapper -->

    @yield('scripts')

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
