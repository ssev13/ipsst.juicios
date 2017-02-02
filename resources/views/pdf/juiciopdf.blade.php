<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Juicios - Asesoría Letrada - IPSST</title>

    {!! Html::style('/assets/css/pdf.css') !!}

  </head>
  <body>

	<div class="clearfix">
	    
	    <div class="">

                <div class="row">
                    
                    <div class="col-lg-12">

                        <div class="table-responsive">
                        	<table>
	                            <tr>
									<td>
									    <h1 class="page-header">
									        Juicio: <small>{{ $juicio->causa }}</small>
									    </h1>
									</td>
								</tr>
								<tr>
									<td>{{ $juicio->descripcion }}</td>
								</tr>
							</table>
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Numero</th>
										<td>{{ $juicio->id }}</td>
										<th>Usuario</th>
										<td>{{ $juicio->user->nombreCompleto }}</td>
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
								</thead>
                            </table>
                        </div>
                    </div>
                </div>

		                    	<table>
		                    		<tr>
		                    			<td>
					                        <h2 class="page-header">
	            								Abogados del Actor
	            							</h2>
				                        </td>
		                   			</tr>
		                   		</table>
	            <p class=""> 
	                @foreach($juicio->abogados as $abogado)
	                        <h4>
	                        	{{ $abogado->nombre }}
	                        </h4>
	                @endforeach
	            </p>
				
				<div class="row">
		                    <div class="col-lg-12">
		                    	<table>
		                    		<tr>
		                    			<td>
					                        <h2 class="page-header">
					                            Eventos
					                        </h2>
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
								</thead>
								<tbody>
                                    @foreach ($eventos as $evento)
										<tr>
                                            <td>{{ $evento->tipoevento->nombre }}</td>
    										<td>{{ $evento->nombre }}</td>
    										<td>{{ $evento->detalle }}</td>
    										<td>{{ $evento->fecha }}</td>
    										<td>{{ $evento->vencimiento }}</td>
    										<td>{{ $evento->observaciones }}</td>
    									</tr>
	                                @endforeach
								</tbody>
							</table>
						</div>
					</div>
				

				<div class="row">
					<div class="col-lg-12">
		                    	<table>
		                    		<tr>
		                    			<td>
					                        <h2 class="page-header">
					                            Historial
					                        </h2>
				                        </td>
		                   			</tr>
		                   		</table>
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
                                            <td>{{ $historial->observaciones }}</td>
										</tr>
                                    @endforeach
								</tbody>
							</table>

	    </div>

	</div>

  </body>
</html>