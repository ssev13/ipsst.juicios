@extends ('layouts.layout')

@section ('content')
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    	<table class="table" border="0">
                            @if($juicio->deleted_at==NULL)
                                <?php $activo = "active" ?>
                            @else
                                <?php $activo = "danger" ?>
                            @endif
                            <tr class="{{ $activo }}">
                    			<td>
			                        <h1 class="page-header">
			                            Juicio: <small>{{ $juicio->causa }}</small>
			                        </h1>
		                        </td>
                            </tr>
                            <tr>
                            <td align="left">
                            <table cellpadding="20" cellspacing="20" border="0">
                            <tr>
                                @if($activo=="active")
    		                        <td>
                                        {!! Form::open(['route' => ['juicios.show', $juicio->id ], 'method' => 'get']) !!}
    										<button type="submit" class="btn btn-default" aria-label="Editar" title="Editar Juicio">
    	     										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
    										</button>
                                        {!! Form::close() !!}
                       				</td>
                       				<td>
                                        {!! Form::open(['route' => ['pdf.juicio', $juicio->id ], 'method' => 'get']) !!}
    										<button type="submit" class="btn btn-default" aria-label="Imprimir" title="Imprimir Juicio">
    	     										<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
    										</button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td> 
    	                                {!! Form::open(['route' => ['juicios.cambiousr', $juicio->id ], 'method' => 'get']) !!}
    	                                    <button type="submit" class="btn btn-default" aria-label="Cambio Usuario" title="Cambio Usuario">
    	                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
    	                                    </button>
    	                                {!! Form::close() !!}
                                    </td>		                        
                       				<td>
                                        {!! Form::open(['route' => ['juicios.borrar', $juicio->id ], 'method' => 'get', 'onsubmit' => 'return confirm("Está seguro de cerrar el juicio?")']) !!}
    	  									<button type="submit" class="btn btn-default" aria-label="Cerrar" title="Cerrar Juicio">
    		    									<span class="glyphicon glyphicon-lock" aria-hidden="false"></span>
    										</button>
                                        {!! Form::close() !!}
                                    </td>
                                @else
                                    <td>
                                        {!! Form::open(['route' => ['pdf.juicio', $juicio->id ], 'method' => 'get']) !!}
                                            <button type="submit" class="btn btn-default" aria-label="Imprimir" title="Imprimir Juicio">
                                                    <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                                            </button>
                                        {!! Form::close() !!}
                                    </td>
                                @endif
                   			</tr>
                            </table>
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
                    
                    <div class="col-lg-12">

                        @include('juicios/partials/errors')

                        <h2></h2>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="15%">Numero</th>
										<td width="40%">{{ $juicio->id }}</td>
										<th width="10%">Usuario</th>
										<td width="35%">{{ $juicio->user->nombreCompleto }}</td>
									</tr>
									<tr>
										<th>Fecha inicio juicio</th>
										<td>{{ $juicio->fecha }}</td>
										<th>Vencimiento</th>
										<td>{{ $juicio->vencimiento }}</td>
									</tr>
                                    <tr>
										<th>Expte Judicial</th>
										<td>{{ $juicio->expediente }}</td>
										<th>Estado</th>
										<td>{{ $juicio->estado->nombre }}</td>
									</tr>
									<tr>
                                        <th>Expte IPSST</th>
                                        <td>{{ $juicio->expteipsst }}</td>
										<th>Objeto</th>
										<td>{{ $juicio->objeto->nombre }}</td>
									</tr>
									<tr>
                                        <th>Juzgado</th>
                                        <td>{{ $juicio->juzgado->nombre }}</td>
                                        <th>Sentencia</th>
                                        <td>{{ $juicio->sentencia->nombre }}</td>
									</tr>
									<tr>
										<th>Descripción</th>
										<td colspan="3">{{ $juicio->descripcion }}</td>
									</tr>
								</thead>
                            </table>
                        </div>
                    </div>
                </div>

            <h2>Abogados del Actor</h2>
            <p class=""> 
                @foreach($juicio->abogados as $abogado)
                    {!! Form::open(['route' => ['abogados.destroy', $juicio->id, $abogado->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Está seguro de eliminar este abogado?")']) !!}
                        {!! csrf_field() !!}
                        <h3>
                        <button type="submit" class="label label-default">
                            {{ $abogado->nombre.' | X' }}
                        </button>
                        </h3>
                    {!! Form::close() !!}
                @endforeach
            </p>

            {!! Form::open(['route' => ['abogados.submit', $juicio->id], 'method' => 'POST']) !!}
                {!! csrf_field() !!}
                {{ Form::label('matricula', 'Matricula') }}
                {{ Form::text('matricula')}}

                <button type="submit" class="btn ">
                    <span class="glyphicon glyphicon-user"></span> Asignar
                </button>
            {!! Form::close() !!}
            <br>

<!--
                <div class="row">
                            <div class="col-lg-12">
                                <table>
                                    <tr>
                                        <td>
                                            <h2 class="page-header">
                                                Archivos del juicio
                                            </h2>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <form action=" {{ url('/addfile', $juicio->id) }}" method="POST" enctype="multipart/form-data">

                                                {!! csrf_field() !!}

                                                <input type="file" class="form-control" name="filefield">
                                                <button type="submit" class="btn ">
                                                    <span class="glyphicon glyphicon-open"></span> Subir archivo
                                                </button>

                                            </form>
				
                                        </td>
                                    </tr>
                                </table>
                        </div>
                    </div>

-->
            <h2>Etiquetas</h2>
            <p class=""> 
                @foreach($etiquetas as $etiqueta)
                    {!! Form::open(['route' => ['etiquetas.destroy', $juicio->id, $etiqueta->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Está seguro de eliminar esta etiqueta?")']) !!}
                        {!! csrf_field() !!}
                        <h3>
                        <button type="submit" class="label label-default">
                            {{ $etiqueta->nombre.' | X' }}
                        </button>
                        </h3>
                    {!! Form::close() !!}
                @endforeach
            </p>

            {!! Form::open(['route' => ['etiquetas.submit', $juicio->id], 'method' => 'POST']) !!}
                {!! csrf_field() !!}

                <div class="form-group col-lg-4" >
                    <select class="form-control" name='etiquetaid'>
                        @foreach($etiquetasfalta as $etiquetafalta)
                            <option value='{{ $etiquetafalta->id }}'> {{ $etiquetafalta->nombre }} </option>
                        @endforeach
                    </select>               
                </div>

                <button type="submit" class="btn ">
                    <span class="glyphicon glyphicon-tags"></span> Etiquetar
                </button>
            {!! Form::close() !!}
            <br>

				<div class="row">
		                    <div class="col-lg-12">
		                    	<table>
		                    		<tr>
		                    			<td>
					                        <h2 class="page-header">
					                            Eventos
					                        </h2>
				                        </td>
				                        <td>&nbsp;</td>
				                        <td>
			                                {!! Form::open(['route' => ['eventos.create', $juicio->id ], 'method' => 'get']) !!}
												<button type="submit" class="btn btn-default" aria-label="Eventos" title="Crear Evento">
														<span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
												</button>
			                                {!! Form::close() !!}
		                   				</td>
		                   			</tr>
		                   		</table>
							<table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Nombre</th>
										<th>Detalle</th>
								        <th>Fecha</th>
										<th>Vencimiento</th>
										<th>Observaciones</th>
										<th>&nbsp;</th>
								</thead>
								<tbody>
                                    @foreach ($eventos as $evento)
										<tr>
                                            <td>{{ $evento->tipoevento->nombre }}</td>
    										<td>{{ $evento->nombre }}</td>
    										<td>{{ $evento->detalle }}</td>
    										<td>{{ $evento->fecha }}</td>
    										<td>{{ $evento->vencimiento }}</td>
    										<td>{!! $evento->observaciones !!}</td>
    										<td>
    											<div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                <table cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td>
                                                    {!! Form::open(['route' => ['eventos.show', $juicio->id, $evento->id ], 'method' => 'get']) !!}
            											<button type="submit" class="btn btn-default" aria-label="Editar evento" title="Editar">
              	     										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            											</button>
                                                    {!! Form::close() !!}
                                                    </td>

                                                    <td>
                                                    {!! Form::open(['route' => ['eventos.delete', $evento->id ], 'method' => 'delete', 'onsubmit' => 'return confirm("Está seguro de eliminar el evento? Esta acción no se puede deshacer.")']) !!}

            		  									<button type="submit" class="btn btn-default" aria-label="Eliminar evento" title="Eliminar">
              		    									<span class="glyphicon glyphicon-trash" aria-hidden="false"></span>
            											</button>

                                                    {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                                </table>
    											</div>
    										</td>
    									</tr>
	                                @endforeach
								</tbody>
							</table>
						</div>
					</div>
				

				<div class="row">
					<div class="col-lg-12">
                        <h2 class="page-header">
		                            Historial
		                        </h2>
                        <div class="table-responsive">
						<table class="table table-hover table-striped">
                                <thead>
                                    <tr>
										<th>Tipo</th>
                                        <th>Nombre</th>
										<th>Detalle</th>
										<th>Fecha</th>
										<th>Usuario</th>
										<th>Obs.</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach ($historials as $historial)
    	                                <tr>
                                            <td>{{ $historial->tipo }}</td>
                                            <td>{{ $historial->nombre }}</td>
                                            <td>{{ $historial->detalle }}</td>
                                            <td>{{ $historial->fecha }}</td>
                                            <td>{{ $historial->user->name }}</td>
                                            <td>{!! $historial->observaciones !!}</td>
										</tr>
                                    @endforeach
								</tbody>
							</table>
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