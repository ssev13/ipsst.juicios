@extends ('layouts.layout')

@section('header')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
@endsection

@section ('content')

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edición de Juicio
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

                        {!! Form::model($juicios, array('juicios.update', $juicios->id)) !!}

                            <div class="form-group">
                                <label>Causa</label>
                                <input name="causa" class="form-control" value="{{ $juicios->causa }}">
                            </div>
							
                            <div class="form-group">
                                <label>Expediente</label>
                                <input name="expediente" readonly class="form-control" value="{{ $juicios->expediente }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Juzgado</label>
                                <select class="form-control" name='juzgado'>
                                    @foreach($juzgados as $juzgado)
                                        {{ ($juzgado->id == $juicios->juzgado_id) ? $sel = 'selected' : $sel = '' }}
                                        <option value='{{ $juzgado->id }}' {{ $sel }}>{{ $juzgado->nombre }}</option>
                                    @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Expediente IPSST</label>
                                <input name="expteipsst" class="form-control" value="{{ $juicios->expteipsst }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Objeto</label>
                                <select class="form-control" name='objeto'>
                                  @foreach($objetos as $objeto)
                                        {{ ($objeto->id == $juicios->objeto_id) ? $sel = 'selected' : $sel = '' }}
                                        <option value='{{ $objeto->id }}' {{ $sel }}>{{ $objeto->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea name="descripcion" class="form-control" rows="3" value="{{ $juicios->descripcion }}">{{ $juicios->descripcion }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" name='estado'>
                                  @foreach($estados as $estado)
                                        {{ ($estado->id == $juicios->estado_id) ? $sel = 'selected' : $sel = '' }}
                                        <option value='{{ $estado->id }}' {{ $sel }}>{{ $estado->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Sentencia</label>
                                <select class="form-control" name='sentencia'>
                                  @foreach($sentencias as $sentencia)
                                        {{ ($sentencia->id == $juicios->sentencia_id) ? $sel = 'selected' : $sel = '' }}
                                        <option value='{{ $sentencia->id }}' {{ $sel }}>{{ $sentencia->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

                            <?php 
                                $fecha_base =  $juicios->fecha; 
                                $fecha_titulo = 'Fecha inicio juicio';
                                $fecha_var = 'fecha';
                            ?>

                            @include('juicios.partials.fecha')

                            <?php 
                                $fecha_base = $juicios->vencimiento; 
                                $fecha_titulo = 'Vencimiento';
                                $fecha_var = 'vencimiento';
                            ?>

                            @include('juicios.partials.fecha')
                          
                            <div class="form-group">
                                <label>Observaciones</label>
                                <textarea name="observaciones" class="form-control" rows="3" value="{{ $juicios->observaciones }}">{{ $juicios->observaciones }}</textarea>
                            </div>
                            
							<button type="submit" class="btn btn-default">Guardar</button>
                            <button onclick="goBack()" class="btn btn-default">Volver</button>

                        {!! Form::close() !!}

                    </div>
                    
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

@endsection

@section('scripts')
    <script>
    function goBack() {
        window.history.back();
    }
    </script>
@endsection