@extends ('layouts.layout')

@section ('content')
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listado de Juicios
                        </h1>

                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    
                    <div class="col-lg-12">

                        @include('juicios/partials/errors')

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nro</th>
                                        <th>Expte</th>
                                        <th>Causa</th>
                                        <th>Abogado</th>
                                        <th>Estado</th>
                                        <th>Vencimiento</th>
										<th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($juicios as $juicio)
                                        @if($juicio->deleted_at==NULL)
                                            <?php $activo = "active" ?>
                                        @else
                                            <?php $activo = "danger" ?>
                                        @endif
                                        <tr class="{{ $activo }}">
                                            <td>{{ $juicio->id }}</td>
                                            <td>{{ $juicio->expediente }}</td>
                                            <td>{{ $juicio->causa }}</td>
                                            <td>{{ $juicio->user->nombreCompleto }}</td>
                                            <td>{{ $juicio->estado->nombre }}</td>
                                            <td>{{ $juicio->vencimiento }}</td>
    										<td>
                                                @if($activo=="active")
        											<div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                    <table cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td> 
                                                        {!! Form::open(['route' => ['juicios.history', $juicio->id ], 'method' => 'get']) !!}
                											<button type="submit" class="btn btn-default" aria-label="Historial" title="Historial">
                      											<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                											</button>
                                                        {!! Form::close() !!}
                                                        </td>
                                                        <td>
                                                        {!! Form::open(['route' => ['eventos.create', $juicio->id ], 'method' => 'get']) !!}
                											<button type="submit" class="btn btn-default" aria-label="Eventos" title="Eventos">
                      											<span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
                											</button>
                                                        {!! Form::close() !!}
                                                        </td>
                                                        <td>
                                                        {!! Form::open(['route' => ['juicios.show', $juicio->id ], 'method' => 'get']) !!}
                											<button type="submit" class="btn btn-default" aria-label="Editar" title="Editar">
                  	     										<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                											</button>
                                                        {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                    </table>
        											</div>
                                                @else
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                    <table cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td> 
                                                            {!! Form::open(['route' => ['juicios.history', $juicio->id ], 'method' => 'get']) !!}
                                                                <button type="submit" class="btn btn-default" aria-label="Historial" title="Historial">
                                                                    <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                                                                </button>
                                                            {!! Form::close() !!}
                                                            </td>
                                                            <td>
                                                            {!! Form::open(['route' => ['juicios.recover', $juicio->id ], 'onsubmit' => 'return confirm("Está seguro de reabrir el juicio?")']) !!}
                                                                <button type="submit" class="btn btn-default" aria-label="Reabrir juicio" title="Reabrir juicio">
                                                                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                                                </button>
                                                            {!! Form::close() !!}
                                                            </td>
                                                            <td>
                                                            {!! Form::open(['route' => ['juicios.borrarfinal', $juicio->id ], 'method' => 'get']) !!}
                                                                <button type="submit" class="btn btn-default" aria-label="Eliminar" title="Borrado completo">
                                                                    <span class="glyphicon glyphicon-trash" aria-hidden="false"></span>
                                                                </button>
                                                            {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    </div>
                                                @endif
    										</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

            {{ $juicios->appends(Request::input())->links() }}
        </div>
        <!-- /#page-wrapper -->

@endsection