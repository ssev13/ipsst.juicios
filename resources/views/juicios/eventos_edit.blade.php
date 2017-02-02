@extends ('layouts.layout')

@section ('content')
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edición de Eventos <small></small>
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

                        {!! Form::model($evento, array('eventos.update', $juicio->id, $evento->id)) !!}

                            <div class="form-group">
                                <label>Nombre</label>
                                <input name="nombre" class="form-control" value="{{ $evento->nombre }}">
                            </div>
							<div class="form-group">
                                <label>Detalle</label>
                                <input name="detalle" class="form-control" value="{{ $evento->detalle }}">
                            </div>
							
							<div class="form-group">
                                <label>Tipo</label>
                                <select name="tipo" class="form-control">
                                    @foreach($tipoeventos as $tipoevento)
                                        {{ ($tipoevento->id == $evento->tipoevento_id) ? $sel = 'selected' : $sel = '' }}
                                        <option value='{{ $tipoevento->id }}' {{ $sel }}>{{ $tipoevento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <?php 
                                $fecha_base = $evento->fecha;
                                $fecha_titulo = 'Fecha';
                                $fecha_var = 'fecha';
                            ?>

                            @include('juicios.partials.fecha')

                            <?php 
                                $fecha_base = $evento->vencimiento;
                                $fecha_titulo = 'Vencimiento';
                                $fecha_var = 'vencimiento';
                            ?>

                            @include('juicios.partials.fecha')

							<div class="form-group">
                                <label>Observaciones</label>
                                <textarea name="obs" class="form-control" rows="3">{{ $evento->observaciones }}</textarea> 
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