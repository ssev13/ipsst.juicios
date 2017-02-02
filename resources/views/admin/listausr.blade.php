@extends ('layouts.layout')

@section ('content')


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> 
                            Listado de Usuarios 
                        </h1>
                        <!--
						<ol class="breadcrumb">
                            
                        </ol>
						-->
                    </div>
                </div>
				<div class="row">
				<form class="navbar-form navbar-left">
                {!! Form::open(['route' => ['admin.listausr', 'id'], 'method' => 'get'])  !!}
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
                                        <th width="30%"><a href="{{ route('admin.listausr', 'email') }}">Email</a></th>
                                        <th width="30%"><a href="{{ route('admin.listausr', 'apellido') }}">Nombre</a></th>
                                        <th width="30%"><a href="{{ route('admin.listausr', 'profile') }}">Perfil</a></th>
                                        <th width="10%"><a href="{{ route('admin.listausr', 'juicios') }}">Juicios</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>
                                            {{ $usuario->email }}
                                        </td>
                                        <td>
                                            {{ $usuario->nombreCompleto }}
                                        </td>
                                        <td>
                                            {{ $usuario->profile }}
                                        </td>
                                        <td align="center">
                                            {{ $usuario->juicios->count() }}											
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
            {{ $usuarios->appends(Request::input())->links() }}

        </div>
        <!-- /#page-wrapper -->

@endsection