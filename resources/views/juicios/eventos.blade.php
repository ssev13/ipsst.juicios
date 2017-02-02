@extends ('layouts.layout')

@section ('content')
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Alta de Eventos <small>{{ $juicio->causa }}</small>
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

<!--
                        <form method="POST" role="form" action=" {{ route('eventos.store', $juicio->id) }}" enctype="multipart/form-data">

-->
                        {!! Form::open(
                            array(
                                'route' => ['eventos.store', $juicio->id], 
                                'class' => 'form', 
                                'novalidate' => 'novalidate', 
                                'files' => true)) !!}

                            <div class="form-group">
                                <label>Nombre de Evento</label>
                                <input name="nombre" class="form-control" value="{{ old('nombre') }}">
                            </div>
							<div class="form-group">
                                <label>Detalle</label>
                                <input name="detalle" class="form-control" value="{{ old('detalle') }}">
                            </div>

                            <div class="form-group">
                                <label>Cambio de Estado del Juicio</label>
                                <select class="form-control" name='estadojuicio'>
                                  @foreach($estados as $estado)
                                        {{ ($juicio->estado_id == $estado->id) ? $sel = 'selected' : $sel = '' }}
                                        <option value='{{ $estado->id }}' {{ $sel }}>{{ $estado->nombre }}</option>
                                  @endforeach
                                </select>               
                            </div>

							<div class="form-group">
                                <label>Tipo</label>
                                <select name="tipo" class="form-control">
                                    @foreach($tipoeventos as $tipoevento)
                                        <option value='{{ $tipoevento->id }}'>{{ $tipoevento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                {!! Form::label('Archivo a subir') !!}
                                {!! Form::file('archivo', null) !!}
                            </div>

                            <?php 
                                $fecha_base = old('fecha'); 
                                $fecha_titulo = 'Fecha';
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
                                <textarea name="obs" class="form-control" rows="3"></textarea>
                            </div>
							
							<button type="submit" class="btn btn-default">Guardar</button>
                            <button type="reset" class="btn btn-default">Limpiar</button>
                            <button onclick="goBack()" class="btn btn-default">Volver</button>

                        </form>

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