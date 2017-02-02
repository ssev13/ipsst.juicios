@extends('layouts.layout')

@section('header')

@endsection

@section('content')

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Estadísticas
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- Morris Charts -->
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Juicios por Abogado en barras</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-bar-chart"></div>
                                <div class="text-right">
                                    <a href="{{ route('juicios.list', 'null') }}">Ver Detalles <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- /.row -->

                <!-- Morris Charts -->
                    <div class="col-lg-8">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Etiquetas por Juicio</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-bar-label"></div>
                                <div class="text-right">
                                    <a href="{{ route('juicios.list', 'null') }}">Ver Detalles <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- /.row -->

                <!-- Flot Charts -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Cantidad de Eventos por Tipo</h3>
                            </div>
                            <div class="panel-body">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-pie-eventos"></div>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('juicios.list', 'null') }}">Ver Detalles <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Cantidad de Juicios por Objeto</h3>
                            </div>
                            <div class="panel-body">
                                <div class="flot-chart">
                                    <div class="flot-chart-content" id="flot-pie-objeto"></div>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('juicios.list', 'null') }}">Ver Detalles <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

@endsection

@section('scripts')

    <script>
        $(function() {
            // Bar Chart Abogados
            Morris.Bar({
                element: 'morris-bar-chart',
                data:  <?php echo json_encode($torta1);?>,
                xkey: 'label',
                ykeys: ['data'],
                labels: ['Juicios'],
                barRatio: 0.4,
                xLabelAngle: 35,
                hideHover: 'auto',
                resize: true
            });
        });

        $(function() {
            // Bar Chart Etiquetas
            Morris.Bar({
                element: 'morris-bar-label',
                data:  <?php echo json_encode($label1);?>,
                xkey: 'label',
                ykeys: ['data'],
                labels: ['Juicios'],
                barRatio: 0.4,
                xLabelAngle: 35,
                hideHover: 'auto',
                resize: true
            });
        });

        // Flot Pie Chart with Tooltips
        $(function() {

            var data =  <?php echo json_encode($torta3);?>;

            var plotObj = $.plot($("#flot-pie-eventos"), data, {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            });

        });        
        // Flot Pie Chart with Tooltips
        $(function() {

            var data =  <?php echo json_encode($torta2);?>;

            var plotObj = $.plot($("#flot-pie-objeto"), data, {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            });

        });        
    </script>



    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
<!--
    <script src="js/plugins/morris/morris-data.js"></script>
-->

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
<!--
    <script src="js/plugins/flot/flot-data.js"></script>
-->
@endsection