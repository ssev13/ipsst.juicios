@extends ('layouts.layout')

@section ('content')
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Panel de Control 
                        </h1>

                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-10">
                        {!! Form::open(['route' => ['juicios.search'], 'method' => 'get', 'class' => 'form-inline']) !!}
                            <div class="form-group">
                                <input type="text" class="form-control" size="80" placeholder="Buscar" name='busqueda'>
                            </div>
                            <button type="submit" class="btn btn-default">Buscar
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.row -->

                <br>

                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ $usuarios }}</div>
                                        <div>Usuarios</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin.listausr', 'id') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver usuarios</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ $juicioxabog.'/'.$juicios }}</div>
                                        <div>Juicios asignados</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('juicios.list', Auth::user()->id ) }}">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver juicios propios</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
					<!--
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">124</div>
                                        <div>New Orders!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
					-->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ $juiciovencexabog.'/'.$juiciosvencidos }}</div>
                                        <div>Vencimientos Semana</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('juicios.list_venc') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver vencimientos</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        @if ($juiciovencexabog == 0)
                            <h1>No hay vencimientos</h1>
                        @else
                            <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Causa</th>
                                            <th>Expediente</th>
                                            <th>Vencimiento</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($vencimientos as $vencimiento)
                                                <tr>
                                                    <td>{{ $vencimiento->id }}</td>
                                                    <td>{{ $vencimiento->causa }}</td>
                                                    <td>{{ $vencimiento->expediente }}</td>
                                                    <td>{{ $vencimiento->vencimiento }}</td>
                                                    <td>
                                                        {!! Form::open(['route' => ['juicios.history', $vencimiento->id ], 'method' => 'get']) !!}
                                                            <button type="submit" class="btn btn-default" aria-label="Historial" title="Historial">
                                                                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                                                            </button>
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

            {{ $vencimientos->render() }}

        </div>
        <!-- /#page-wrapper -->

@endsection