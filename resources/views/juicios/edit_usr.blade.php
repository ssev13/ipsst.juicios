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
                            Cambio de Usuario
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

                        {!! Form::model($juicios, array('juicios.usr_store', $juicios->id)) !!}

                            <div class="form-group">
                                <label>Usuario</label>
                                <select class="form-control" name='usuario'>
                                    @foreach($usuarios as $usuario)
                                        {{ ($usuario->id == $juicios->user_id) ? $sel = 'selected' : $sel = '' }}
                                        <option value='{{ $usuario->id }}' {{ $sel }}>{{ $usuario->nombreComun }}</option>
                                    @endforeach
                                </select>               
                            </div>

                            <div class="form-group">
                                <label>Causa</label>
                                <input name="causa" readonly class="form-control" value="{{ $juicios->causa }}">
                            </div>
							
                            <div class="form-group">
                                <label>Expediente</label>
                                <input name="expediente" readonly class="form-control" value="{{ $juicios->expediente }}">
                            </div>
                            
                            <div class="form-group">
                                <label>juzgado</label>
                                <input name="juzgado" readonly class="form-control" value="{{  $juicios->juzgado()->first()->nombre  }}">
                            </div>
<!--
                            <div class="form-group">
                                <label>Expediente IPSST</label>
                                <input name="expteipsst" readonly class="form-control" value="{{ $juicios->expteipsst }}">
                            </div>
                            
                            <div class="form-group">
                                <label>objeto</label>
                                <input name="objeto" readonly class="form-control" value="{{  $juicios->objeto()->first()->nombre  }}">
                            </div>

                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea name="descripcion" readonly class="form-control" rows="3" value="{{ $juicios->descripcion }}">{{ $juicios->descripcion }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>estado</label>
                                <input name="estado" readonly class="form-control" value="{{  $juicios->estado()->first()->nombre  }}">
                            </div>

                            <div class="form-group">
                                <label>sentencia</label>
                                <input name="sentencia" readonly class="form-control" value="{{  $juicios->sentencia()->first()->nombre  }}">
                            </div>

                            <div class="form-group">
                                <label>Fecha</label>
                                <textarea name="descripcion" readonly class="form-control" rows="3" value="{{ $juicios->fecha }}">{{ $juicios->fecha }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Vencimiento</label>
                                <textarea name="descripcion" readonly class="form-control" rows="3" value="{{ $juicios->vencimiento }}">{{ $juicios->vencimiento }}</textarea>
                            </div>
-->
                          
                            <div class="form-group">
                                <label>Observaciones</label>
                                <textarea name="observaciones" readonly class="form-control" rows="3" value="{{ $juicios->observaciones }}">{{ $juicios->observaciones }}</textarea>
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