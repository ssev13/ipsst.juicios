@extends ('layouts.layout')

@section('header')
@endsection

@section ('content')

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Reportes
                        </h1>
                        <h4>                        
                            Registros encontrados: {{ $cantidad }}
                        </h4>
                        <!--
                        <ol class="breadcrumb">
                            
                        </ol>
                        -->
                    </div>

                        @include('juicios/partials/errors')

                </div>
                <!-- /.row -->
					<div class="row">
						<div class="col-lg-12">
							<div class="btn-group" role="group" aria-label="...">
                                <table>
                                    <tr>
                                        <td>
                                            {!! Form::open(['route' => ['pdf.report', 'pdf.reportpdf'], 'method' => 'POST']) !!}
                                                <button type="submit" class="btn btn-default" aria-label="Imprimir a PDF" title="Imprimir a PDF">
                                                    <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                                                </button>
                                                <input type="hidden" name="fecha_desde" value="{{ $request->fecha_desde }}">
                                                <input type="hidden" name="fecha_hasta" value="{{ $request->fecha_hasta }}">
                                                <input type="hidden" name="vence_desde" value="{{ $request->vence_desde }}">
                                                <input type="hidden" name="vence_hasta" value="{{ $request->vence_hasta }}">
                                                <input type="hidden" name="abogado" value="{{ $request->abogado }}">
                                                <input type="hidden" name="descripcion" value="{{ $request->descripcion }}">
                                                <input type="hidden" name="juzgado" value="{{ $request->juzgado }}">
                                                <input type="hidden" name="objeto" value="{{ $request->objeto }}">
                                                <input type="hidden" name="estado" value="{{ $request->estado }}">
                                                <input type="hidden" name="sentencia" value="{{ $request->sentencia }}">
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            {!! Form::open(['route' => ['pdf.report', 'pdf.reportpdf_desc'], 'method' => 'POST']) !!}
                                                <button type="submit" class="btn btn-default" aria-label="Imprimir a PDF con descripcion" title="Imprimir a PDF con descripcion">
                                                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                                </button>
                                                <input type="hidden" name="fecha_desde" value="{{ $request->fecha_desde }}">
                                                <input type="hidden" name="fecha_hasta" value="{{ $request->fecha_hasta }}">
                                                <input type="hidden" name="vence_desde" value="{{ $request->vence_desde }}">
                                                <input type="hidden" name="vence_hasta" value="{{ $request->vence_hasta }}">
                                                <input type="hidden" name="abogado" value="{{ $request->abogado }}">
                                                <input type="hidden" name="descripcion" value="{{ $request->descripcion }}">
                                                <input type="hidden" name="juzgado" value="{{ $request->juzgado }}">
                                                <input type="hidden" name="objeto" value="{{ $request->objeto }}">
                                                <input type="hidden" name="estado" value="{{ $request->estado }}">
                                                <input type="hidden" name="sentencia" value="{{ $request->sentencia }}">
                                            {!! Form::close() !!}
                                        </td>
<!--                                        
                                        <td>
        									<button type="button" class="btn btn-default" aria-label="Eventos">
        										<span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
        									</button>
                                        </td>
                                        <td>
        									<button type="button" class="btn btn-default" aria-label="Editar">
        										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        									</button>
                                        </td>
-->
                                    </tr>
								</table>	
							</div>
						</div>
					</div>
					
					<div class="row">
                    
                    <div class="col-lg-12">
                        <h2></h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Expte</th>
                                        <th>Causa</th>
                                        <th>Abogado</th>
                                        <th>Juzgado</th>
										<th>Objeto</th>
										<th>Estado</th>
										<th>Fecha</th>
										<th>Vence</th>
                                        <th></th>
									</tr>
                                </thead>
                                <tbody>
                                    @foreach ($resultados as $resultado)
                                        <tr>
                                            <td>{{ $resultado->id }}</td>
                                            <td>{{ $resultado->expediente }}</td>
                                            <td>{{ $resultado->causa }}</td>
                                            <td>{{ $resultado->user->nombreCompleto }}</td>
                                            <td>{{ $resultado->juzgado->nombre }}</td>
    										<td>{{ $resultado->objeto->nombre }}</td>
                                            <td>{{ $resultado->estado->nombre }}</td>
                                            <td>{{ $resultado->fecha }}</td>
    										<td>{{ $resultado->vencimiento }}</td>
                                            <td>
                                                {!! Form::open(['route' => ['juicios.history', $resultado->id ], 'method' => 'get']) !!}
                                                    <button type="submit" class="btn btn-default" aria-label="Historial" title="Historial">
                                                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                                                    </button>
                                                {!! Form::close() !!}                                            
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                {{ $resultados->appends(Request::input())->links() }}

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

@endsection