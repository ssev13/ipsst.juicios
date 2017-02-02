@extends ('layouts.layout')

@section ('content')
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listado de Juicios Cerrados
                        </h1>
                        <!--
						<ol class="breadcrumb">
                            
                        </ol>
						-->
                    </div>
                </div>
                <!-- /.row -->

                

                <div class="row">
                    
                    <div class="col-lg-12">

                        @include('juicios/partials/errors')

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Expte</th>
                                        <th>Causa</th>
                                        <th>Abogado</th>
                                        <th>Estado</th>
                                        <th>Vencimiento</th>
										<th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($juicios as $juicio)
                                        <tr>
                                            <td>{{ $juicio->id }}</td>
                                            <td>{{ $juicio->expediente }}</td>
                                            <td>{{ $juicio->causa }}</td>
                                            <td>{{ $juicio->user->nombreCompleto }}</td>
                                            <td>{{ $juicio->estado->nombre }}</td>
                                            <td>{{ $juicio->vencimiento }}</td>
    										<td>
    											<div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                <table cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td> 
                                                        {!! Form::open(['route' => ['juicios.history', $juicio->id ], 'method' => 'get']) !!}
                											<button type="submit" class="btn btn-default" aria-label="Historial" title="Historial">
                      											<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                											</button>
                                                        {!! Form::close() !!}
                                                        </td>
                                                        <td>
                                                        {!! Form::open(['route' => ['juicios.recover', $juicio->id ], 'onsubmit' => 'return confirm("Está seguro de reabrir el juicio?")']) !!}
                											<button type="submit" class="btn btn-default" aria-label="Reabrir juicio" title="Reabrir juicio">
                  	     										<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                											</button>
                                                        {!! Form::close() !!}
                                                        </td>
                                                        <td>
                                                        {!! Form::open(['route' => ['juicios.borrarfinal', $juicio->id ], 'method' => 'get']) !!}
                		  									<button type="submit" class="btn btn-default" aria-label="Eliminar" title="Borrado completo">
                  		    									<span class="glyphicon glyphicon-trash" aria-hidden="false"></span>
                											</button>
                                                        {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                </table>
    											</div>
    										</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

<!--                <div class="row">
                    <div class="col-lg-6">
                        <h2>Contextual Classes</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Page</th>
                                        <th>Visits</th>
                                        <th>% New Visits</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="active">
                                        <td>/index.html</td>
                                        <td>1265</td>
                                        <td>32.3%</td>
                                        <td>$321.33</td>
                                    </tr>
                                    <tr class="success">
                                        <td>/about.html</td>
                                        <td>261</td>
                                        <td>33.3%</td>
                                        <td>$234.12</td>
                                    </tr>
                                    <tr class="warning">
                                        <td>/sales.html</td>
                                        <td>665</td>
                                        <td>21.3%</td>
                                        <td>$16.34</td>
                                    </tr>
                                    <tr class="danger">
                                        <td>/blog.html</td>
                                        <td>9516</td>
                                        <td>89.3%</td>
                                        <td>$1644.43</td>
                                    </tr>
                                    <tr>
                                        <td>/404.html</td>
                                        <td>23</td>
                                        <td>34.3%</td>
                                        <td>$23.52</td>
                                    </tr>
                                    <tr>
                                        <td>/services.html</td>
                                        <td>421</td>
                                        <td>60.3%</td>
                                        <td>$724.32</td>
                                    </tr>
                                    <tr>
                                        <td>/blog/post.html</td>
                                        <td>1233</td>
                                        <td>93.2%</td>
                                        <td>$126.34</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2>Bootstrap Docs</h2>
                        <p>For complete documentation, please visit <a target="_blank" href="http://getbootstrap.com/css/#tables">Bootstrap's Tables Documentation</a>.</p>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

            {{ $juicios->render() }}
        </div>
        <!-- /#page-wrapper -->

@endsection