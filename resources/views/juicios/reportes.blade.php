@extends ('layouts.layout')

@section ('content')

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Reportes
                        </h1>
                        <!--
						<ol class="breadcrumb">
                            
                        </ol>
						-->
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
					<div class="col-lg-6">

                        @include('juicios/partials/errors')

                        {!! Form::open(['route' => ['juicios.report_show'], 'method' => 'get']) !!}

                            <div class="form-group">
                                <table>
                                <tr>

                                    <?php 
                                        $fecha_base = ''; //date("Y-m-d");
                                        $fecha_titulo = 'Fecha Desde';
                                        $fecha_var = 'fecha_desde';
                                    ?>

                                    @include('juicios.partials.fecha')
                                  
                                    <?php 
                                        $fecha_base = ''; //date("Y-m-d H:i:s"); 
                                        $fecha_titulo = 'Fecha Hasta';
                                        $fecha_var = 'fecha_hasta';
                                    ?>

                                    @include('juicios.partials.fecha')

                                </tr>
                                </table>
                           </div>

                            <div class="form-group">
								<table>
								<tr>

                                    <?php 
                                        $fecha_base = ''; //'2016-11-01';//date("Y-m-d");
                                        $fecha_titulo = 'Vencimiento Desde';
                                        $fecha_var = 'vence_desde';
                                    ?>

                                    @include('juicios.partials.fecha')
                                  
                                    <?php 
                                        $fecha_base = ''; //$vencimiento_hasta; 
                                        $fecha_titulo = 'Vencimiento Hasta';
                                        $fecha_var = 'vence_hasta';
                                    ?>

                                    @include('juicios.partials.fecha')

								</tr>
								</table>
                           </div>
							
                            <div class="form-group">
                                <label>Abogado</label>
                                <select class="form-control" name='abogado'>
                                    <option value=''>Todas las opciones  ...</option>
                                    @foreach($abogados as $abogado)
                                        {{ ($abogado->id == $usuario->id) ? $sel = 'selected' : $sel = '' }}
                                        <option value='{{ $abogado->id }}' {{ $sel }}>{{ $abogado->nombreCompleto }}</option>
                                    @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Descripcion</label>
                                <input type="text" class="form-control" size="80" placeholder="Descripcion" name='descripcion' id='descripcion'>
                            </div>

                            <div class="form-group">
                                <label>Juzgado</label>
                                <select class="form-control" name='juzgado'>
                                  <option value=''>Todas las opciones  ...</option>
                                  @foreach($juzgados as $juzgado)
                                        <option value='{{ $juzgado->id }}'>{{ $juzgado->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Objeto</label>
                                <select class="form-control" name='objeto'>
                                  <option value=''>Todas las opciones  ...</option>
                                  @foreach($objetos as $objeto)
                                        <option value='{{ $objeto->id }}'>{{ $objeto->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" name='estado'>
                                  <option value=''>Todas las opciones  ...</option>
                                  @foreach($estados as $estado)
                                        <option value='{{ $estado->id }}'>{{ $estado->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Sentencia</label>
                                <select class="form-control" name='sentencia'>
                                  <option value=''>Todas las opciones  ...</option>
                                  @foreach($sentencias as $sentencia)
                                        <option value='{{ $sentencia->id }}'>{{ $sentencia->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

							<div class="form-group">
                                <input type="submit" class="btn btn-default" value="Buscar">
                            </div>
    
                        {!! Form::close() !!}
	
    				</div>
					
				</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

@endsection