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
	    	<table>
			    <tr>    
			    	<td>
			    		<h2>Reporte de Causas</h2>
			    	</td>
			    	<td>
			    		<h4 align="right">Fecha de reporte: {{ $date }}</h4>
			    	</td>
			    </tr>
			    <tr>
			    	<td>
		    			{{ $usuario }}
			    	</td>
			    	<td>
			        	<h4 align="right">Cantidad de registros: {{ $cantidad }}</h4>
			        </td>
			    </tr>
	        </table>
	        <div class="table">
	            <table class="table table-striped">
	                <thead>
	                    <tr>
	                        <th width="2%">Nro</th>
	                        <th width="2%">Expte</th>
	                        <th width="20%">Causa</th>
	                        <th width="20%">Abogado</th>
	                        <th width="10%">Juzgado</th>
							<th width="10%">Objeto</th>
							<th width="10%">Estado</th>
							<th width="10%">Fecha</th>
							<th width="10%">Vencimiento</th>
						</tr>
	                </thead>
	                <tbody>
	                    @foreach ($products as $product)
	                        <tr>
	                            <td>{{ $product->id }}</td>
	                            <td>{{ $product->expediente }}</td>
	                            <td>{{ $product->causa }}</td>
	                            <td>{{ $product->user->nombreCompleto }}</td>
	                            <td>{{ $product->juzgado->nombre }}</td>
								<td>{{ $product->objeto->nombre }}</td>
	                            <td>{{ $product->estado->nombre }}</td>
	                            <td>{{ $product->fecha }}</td>
								<td>{{ $product->vencimiento }}</td>
	                        </tr>
	                    @endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>

	</div>

  </body>
</html>