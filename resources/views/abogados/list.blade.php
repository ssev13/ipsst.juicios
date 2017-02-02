@extends ('layouts.layout')

@section ('content')

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> 
                            Listado de Abogados de parte Actora 
                        </h1>
                        {!! Form::open(['route' => ['abogados.create'], 'method' => 'get']) !!}
                            <button type="submit" class="btn btn-default" aria-label="Agregar">Agregar
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        {!! Form::close() !!}
                        <!--
						<ol class="breadcrumb">
                            
                        </ol>
						-->
                    </div>
                </div>
				<div class="row">
				<form class="navbar-form navbar-left">
                {!! Form::open(['route' => ['abogados.list'], 'method' => 'get'])  !!}
    		        <div class="form-group">
    		          <input type="text" class="form-control" placeholder="Buscar" id="buscar" name="buscar">
    		        </div>
    		        <button type="submit" class="btn btn-default">Buscar</button>
		        </form>
				</div>
                <!-- /.row -->
				<div class="row">
                    
                    <div class="col-lg-12">

                        @include('juicios/partials/errors')

                    
                        <h2></h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th width="10%">Matricula</th>
                                        <th width="25%">Nombre</th>
                                        <th width="55%">Observaciones</th>
                                        <th width="10%">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($abogados as $abogado)
                                    <tr>
                                        <td>
                                            {{ $abogado->matricula }}
                                        </td>
                                        <td>
                                            {{ $abogado->nombre }}
                                        </td>
                                        <td>
                                            {{ $abogado->observaciones }}
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td>
                                                {!! Form::open(['route' => ['abogados.show', $abogado->id ], 'method' => 'get']) !!}

        											<button type="submit" class="btn btn-default" aria-label="Editar">
          											<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        											</button>
                                                {!! Form::close() !!}
                                                    </td>
                                                    <td>

                                                {!! Form::open(['route' => ['abogados.delete', $abogado->id ], 'method' => 'delete', 'onsubmit' => 'return confirm("Está seguro de eliminar este abogado?")']) !!}
        											<button type="submit" class="btn btn-default" aria-label="Historial">
          											<span class="glyphicon glyphicon-trash" aria-hidden="false"></span>
        											</button>
                                                {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            </table>
											
										</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
            {{ $abogados->appends(Request::input())->links() }}

        </div>
        <!-- /#page-wrapper -->

@endsection