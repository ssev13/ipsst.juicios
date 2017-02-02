@if (! $errors->isEmpty())
	<div class="alert alert-danger">
		<p><strong>Error!!!</strong>  Solucione los siguientes errores:</p>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('danger'))
    <div class="alert alert-danger">
        {{ Session::get('danger') }}
    </div>
@endif