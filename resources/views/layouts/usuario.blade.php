
            <ul class="nav navbar-right top-nav">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Ingreso</a></li>
                    <li><a href="{{ url('/register') }}">Registro</a></li>
                @else
                    
                    
                    <!-- 
                        @ include('layouts.notify')
                    -->
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-fw fa-cog"></i><span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="nav">
                                <a href="{{ route('abogados.list') }}"><i class="fa fa-fw fa-book"></i> Abogados</a>
                            </li>
                            <li class="nav">
                                <a href="{{ route('etiquetas.list') }}"><i class="fa fa-fw fa-tags"></i> Etiquetas</a>
                            </li>
                            <li class="nav">
                                <a href="{{ route('estados.list') }}"><i class="fa fa-fw fa-bookmark"></i> Estados</a>
                            </li>
                            <li class="nav">
                                <a href="{{ route('tipoeventos.list') }}"><i class="fa fa-fw fa-th"></i> Tipos Evento</a>
                            </li>
                            <li class="nav">
                                <a href="{{ route('objetos.list') }}"><i class="fa fa-fw fa-paperclip"></i> Objetos</a>
                            </li>
                            <li class="nav">
                                <a href="{{ route('juzgados.list') }}"><i class="fa fa-fw fa-star"></i> Juzgados</a>
                            </li>
                            <li class="nav">
                                <a href="{{ route('sentencias.list') }}"><i class="fa fa-fw fa-th-list"></i> Sentencias</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @if (Auth::user()->profile == 'Tecnico')
                                <li>
                                    <a href="{{ route('admin.listausr', 'id') }}"><i class="fa fa-fw fa-user"></i> Usuarios</a>
                                </li>
                            @endif

<!--                        
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
-->                            
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="glyphicon glyphicon-off"></i> Salir
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                @endif
            </ul>
