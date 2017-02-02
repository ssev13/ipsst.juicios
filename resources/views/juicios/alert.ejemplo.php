                                                        <td>
                                                        {!! Form::open(['route' => ['eventos.create', $juicio->id ]]) !!}
                											<button type="button" class="btn btn-default" aria-label="Eventos" title="Eventos" onclick="alert('No puede agregar eventos si el juicio está en la papelera')">
                      											<span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
                											</button>
                                                        {!! Form::close() !!}
                                                        </td>
