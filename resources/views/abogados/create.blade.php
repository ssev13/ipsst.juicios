@extends ('layouts.layout')

@section ('content')

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Gestión de Abogados de parte Actora
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

                        <form method="POST" role="form" action=" {{ route('abogados.store') }}">

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label>Matricula</label>
                                <input name="matricula" class="form-control">
                            </div>
							
							<div class="form-group">
                                <label>Nombre</label>
                                <input name="nombre" class="form-control">
                            </div>
							
							<div class="form-group">
                                <label>Observaciones</label>
                                <textarea name="observaciones" class="form-control"></textarea>
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