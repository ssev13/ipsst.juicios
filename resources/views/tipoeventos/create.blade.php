@extends ('layouts.layout')

@section ('content')

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Alta de Tipo de eventos
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

                        <form method="POST" role="form" action=" {{ route('tipoeventos.store') }}">

                            {!! csrf_field() !!}

							<div class="form-group">
                                <label>Nombre</label>
                                <input name="nombre" class="form-control">
                            </div>
							
							<div class="form-group">
                                <label>Detalle</label>
                                <textarea name="detalle" class="form-control"></textarea>
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