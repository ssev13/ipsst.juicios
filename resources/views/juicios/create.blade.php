@extends ('layouts.layout')

@section ('content')

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-8">
                    <table>
                        <tr>
                            <td>
                                <h1 class="page-header">
                                    Alta de Juicio
                                </h1>
                            </td>
                            <td>
                                <?php 
                                    $ayuda_titulo = 'Alta de Expedientes';
                                    $ayuda_texto  = '
                                    <p>Los datos deben tener el siguiente formato: </p>
                                    <p>
                                        <b>Causa (*)</b>: <i>{Nombre del actor}</i><b> C/</b><i>{IPSST o demandado}</i> <b> S/</b><i>{Objeto del Juicio}</i><br><br>
                                        <b>Expediente Judicial (*)</b>: <i>{Número de expediente}</i><b>/</b><i>{Año}</i><br><br>
                                        <b>Expediente IPSST</b>: <i>Puede ingresar todos los expedientes que desee. Debe ingresar el número seguido de dos puntos, un detalle del expediente y separarlo con un punto y coma. Ej: 1-123456-2017: Pedido de cobertura; 1-234567-2017: Cautelar;</i><br><br>
                                        <b>Descripción (*)</b>: <i>Debe ser lo más detallado posible para poder utilizar la información en los reportes y estadísticas</i><br><br>
                                        <b>Fecha de inicio del juicio (*)</b>: <i>Debe ingresarse la fecha en que se inició el juicio. Si no tiene esa información deberá poner la fecha de ingreso a la institución.</i><br><br>
                                        <b>Fecha de vencimiento</b>: <i>Se debe especificar esta fecha en caso que el juicio tenga un vencimiento al momento de ingresar, caso contrario se debe dejar en blanco</i><br><br>
                                        <b>Observaciones</b>: <i>Se debe especificar cualquier información que resulte útil pero que no sea parte de la descripción.</i><br><br>


                                    </p>
                                    <p>
                                        (*) Campos obligatorios
                                    </p>';
                                ?>
                                @include('juicios.partials.ayuda')
                            </td>
                        </tr>
                    </table>
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

                        <form method="POST" role="form" action=" {{ route('juicios.store') }}">

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label>Causa</label>
                                <input name="causa" class="form-control" value="{{ old('causa') }}">
                            </div>

                            <div class="form-group">
                                <label>Expediente Judicial</label>
                                <input name="expediente" class="form-control" value="{{ old('expediente') }}">
                            </div>

                            <div class="form-group">
                                <label>Juzgado</label>
                                <select class="form-control" name='juzgado'>
                                  @foreach($juzgados as $juzgado)
                                        <option value='{{ $juzgado->id }}'>{{ $juzgado->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Expediente IPSST</label>
                                <input name="expteipsst" class="form-control" value="{{ old('expteipsst') }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Objeto</label>
                                <select class="form-control" name='objeto'>
                                  @foreach($objetos as $objeto)
                                        <option value='{{ $objeto->id }}'>{{ $objeto->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea name="descripcion" class="form-control" rows="3" value="{{ old('descripcion') }}">{{ old('descripcion') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" name='estado'>
                                  @foreach($estados as $estado)
                                        <option value='{{ $estado->id }}'>{{ $estado->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Sentencia</label>
                                <select class="form-control" name='sentencia'>
                                  @foreach($sentencias as $sentencia)
                                        <option value='{{ $sentencia->id }}'>{{ $sentencia->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <?php 
                                $fecha_base = old('fecha'); 
                                $fecha_titulo = 'Fecha inicio juicio';
                                $fecha_var = 'fecha';
                            ?>

                            @include('juicios.partials.fecha')

                            <?php 
                                $fecha_base = old('vencimiento'); 
                                $fecha_titulo = 'Vencimiento';
                                $fecha_var = 'vencimiento';
                            ?>

                            @include('juicios.partials.fecha')

                            <div class="form-group">
                                <label>Observaciones</label>
                                <textarea name="observaciones" class="form-control" rows="3" value="{{ old('observaciones') }}">{{ old('observaciones') }}</textarea>
                            </div>
                            
							<button type="submit" class="btn btn-default">Guardar</button>

                        </form>

                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

@endsection
