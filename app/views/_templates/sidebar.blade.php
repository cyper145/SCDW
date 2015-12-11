<form role="search">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
    </div>
</form>
<ul class="nav menu">
    <!-- ////////////////////////////////////BEGIN USER PARA TODOS LOS USUARIOS ////////////////////////////////////-->
    <li><a href="{{URL::to('/')}}"><span class="glyphicon glyphicon-dashboard"></span> Inicio</a></li>
    
    <!-- //////////////////////////////////// END USER PARA TODOS LOS USUARIOS ////////////////////////////////////-->
    @if(!Session::has('user_id'))<!-- si no hay ninguna sesion iniciada-->
    
        <!-- ////////////////////////////////////BEGIN USER NORMAL////////////////////////////////////-->
        <li><a href="{{URL::to('/fixture/ver')}}"><span class="glyphicon glyphicon-hand-up"></span> Ver Fixture</a></li>
        <li><a href="{{URL::to('tablaposicion/ver.html')}}"><span class="glyphicon glyphicon-stats"></span> Ver Tabla de posiciones</a></li>
        <li><a href="{{URL::to('/Otros/ver')}}"><span class="glyphicon glyphicon-hand-up"></span> Ver Otros</a></li>
        <!-- ////////////////////////////////////END USER NORMAL////////////////////////////////////-->
        
    @else      
        <?php 
        if(User::isAdministrator())
        { ?>
            <!-- //////////////////////////////////// BEGIN USER ADMINISTRADOR ////////////////////////////////////-->

                <!-- begin cuentas de usuarios  -->
                <li class="parent ">
                    <a href="javascript:void(0)">
                        <span class="glyphicon glyphicon-user"></span> Usuarios <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                    </a>
                    <ul class="children collapse" id="sub-item-1">
                        <li>
                            <a class="" href="{{ URL::to('usuario/listar');}}">
                                <span class="glyphicon glyphicon-share-alt"></span> Administradores
                            </a>
                        </li>
                        <li>
                            <a class="" href="{{ URL::to('usuariocorg/listar');}}">
                                <span class="glyphicon glyphicon-share-alt"></span> Organizadores
                            </a>
                        </li>
                        <li>
                            <a class="" href="{{ URL::to('usuarioequipo/listar');}}">
                                <span class="glyphicon glyphicon-share-alt"></span> Equipos
                            </a>
                        </li>
                    </ul>                    
                </li>
                <!-- End cuentas de usuarios  -->
            <!-- begin miembro comision de justicia -->
            <li class="parent ">
                <a href="{{ URL::to( 'miembrocomjusticia/listar');}}">
                    <span class="glyphicon glyphicon-user"></span>Comision de Justicia<span data-toggle="collapse" href="#sub-item-miembro" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-miembro">
                    <li>
                        <a class="" href="{{ URL::to( 'miembrocomjusticiainsertar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> ingresar Nuevo Miembro
                        </a>
                    </li>
                </ul>
            </li>
            <!-- end miembro comision de justicia -->
            <!-- begin docente -->
            <li class="parent ">
                <a href="{{ URL::to( 'docente/listar');}}">
                    <span class="glyphicon glyphicon-user"></span> Docentes <span data-toggle="collapse" href="#sub-item-docente" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>

                <ul class="children collapse" id="sub-item-docente">
                    <li>
                        <a class="" href="{{ URL::to( 'docente/insertar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Agregar Docente
                        </a>
                    </li>

                </ul>
            </li>
            <!-- end docente-->
            <!-- begin departamento academico -->
            <li class="parent ">
                <a href="{{ URL::to( 'DptoAcademico/listar');}}">
                    <span class="glyphicon glyphicon-user"></span> Departamento Academico <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>

                <ul class="children collapse" id="sub-item-2">
                    <li>
                        <a class="" href="{{ URL::to( 'DptoAcademico/insertar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Agregar
                        </a>
                    </li>

                </ul>
            </li>
            <!-- end departamento academico -->
            <li><a href="{{URL::to('#')}}"><span class="glyphicon glyphicon-hand-up"></span> Importar docentes</a></li>
                
            <!-- ////////////////////////////////////END USER ADMINISTRADOR ////////////////////////////////////-->
        <?php 
        }
        else
        {
            if(User::isOrganizingCommittee())
            {?>
            <!-- ////////////////////////////////////BEGIN USER COMISION ORGANIZADORA////////////////////////////////// -->
            <li><a href="{{URL::to('comision/index.html')}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <!-- begin integrantes -->
            <li><a href="{{URL::to('comision/integrantes/list.html')}}"><span class="glyphicon glyphicon-list"></span> Integrantes</a></li>
            <!-- end integrantes -->

            <!-- begin campeonato -->
            <li><a href="{{URL::to('campeonato/listar')}}"><span class="glyphicon glyphicon-list"></span> Camponatos</a></li>
            <!-- end campeonato -->
            <!-- begin jugador en juego-->
            <li class="parent {{ (Request::is( 'jugador') || Request::is( 'jugador/*')) ? 'active open' : ''}}">
                <a href="javascript:void(0)">
                    <span class="glyphicon glyphicon-user"></span> Jugador en juego <span data-toggle="collapse" href="#sub-item-sin_j" class="icon pull-right">
                <em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-sin_j">
                    <li>
                        <a class="{{ Request::is( 'jugador_juego/index') ? 'active open' : '' }}" href="{{URL::to('jugador_juego/')}}">
                            <span class="glyphicon glyphicon-list"></span> Jugadores en juego
                        </a>
                    </li>
                    <li>
                        <a class="{{ Request::is( 'jugador_juego/create') ? 'active open' : '' }}" href="{{URL::to('jugador_juego/create')}}">
                            <span class="glyphicon glyphicon-plus"></span> Agregar jugador en juego
                        </a>
                    </li>
                </ul>
            </li>
            <!-- en jugador en juego -->
            <!-- begin Arbitro -->
            <li class="parent ">
                <a href="{{ URL::to( 'arbitros/listar');}}">
                    <span class="glyphicon glyphicon-user"></span> Arbitros <span data-toggle="collapse" href="#sub-item-11" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-11">
                    <li>
                        <a class="" href="{{ URL::to( 'arbitros/listar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Listar
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ URL::to( 'arbitros/agregar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Insertar
                        </a>
                    </li>

                    <li>
                        <a class="" href="{{ URL::to( 'arbitros/buscar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Buscar
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ URL::to( 'arbitros/porPartido');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Por Partido
                        </a>
                    </li>
                </ul>
            </li>
            <!-- end Arbitros-->
            <!-- begin movimiento -->
            <li class="parent ">
                <a href="{{ URL::to( 'movimientos');}}">
                    <span class="glyphicon glyphicon-user"></span> CAJA <span data-toggle="collapse" href="#sub-item-13" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-13">

                    <li>
                        <a class="" href="{{ URL::to( 'ingresos/listar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Ingresos
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ URL::to( 'egresos/listar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Egresos
                        </a>
                    </li>
                </ul>
            </li>
            <!-- end movimiento -->
            <!-- begin gol -->
            <li class="parent ">
                <a href="{{ URL::to( 'gol/');}}">
                    <span class="glyphicon glyphicon-dashboard"></span> Gol <span data-toggle="collapse" href="#sub-item-12" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-12">
                    <li>
                        <a class="" href="{{ URL::to( 'gol/insertar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Ingresar
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ URL::to( 'gol/listar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> listar
                        </a>
                    </li>
                </ul>
            </li>
            <!-- end gol -->

            <!-- begin bases -->
            <li class="parent ">
                <a href="base/ver">
                    <span class="glyphicon glyphicon-book"></span> bases <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-4">
                    <li>
                        <a class="" href="#">
                            <span class="glyphicon glyphicon-share-alt"></span> ingresar bases
                        </a>
                    </li>
                </ul>
            </li>
            <!-- end bases -->

            <!-- begin cronograma -->
            <li class="parent ">
                <a href="cronograma/ver">
                    <span class="glyphicon glyphicon-dashboard"></span> cronograma <span data-toggle="collapse" href="#sub-item-cronograma" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-cronograma">
                    <li>
                        <a class="" href="#">
                            <span class="glyphicon glyphicon-share-alt"></span> ingresar cronograma
                        </a>
                    </li>
                </ul>
            </li>
            <!-- end cronograma -->

            <!-- begin partido -->
            <li class="parent ">
                <a href="partido/listar">
                    <span class="glyphicon glyphicon-list"></span> partidos <span data-toggle="collapse" href="#sub-item-5" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-5">
                    <li>
                        <a class="" href="#">
                            <span class="glyphicon glyphicon-share-alt"></span> registrar nuevo partido
                        </a>
                    </li>
                </ul>
            </li>
            <!-- begin sanciones -->
            <li class="parent ">
                <a href="{{ URL::to( 'sancion/listar');}}">
                    <span class="glyphicon glyphicon-user"></span> Sanciones <span data-toggle="collapse" href="#sub-item-10" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-10">
                    <li>
                        <a class="" href="{{ URL::to( 'sancion/insertar')}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Nueva Sancion
                        </a>
                    </li>
                </ul>
            </li>
            <!--end sanciones -->

            <!-- begin insidencias -->
            <li class="parent ">
                <a href="{{ URL::to( 'incidencias/listar');}}">
                    <span class="glyphicon glyphicon-user"></span> Incidencias <span data-toggle="collapse" href="#sub-item-insidencias" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-insidencias">
                    <li>
                        <a class="" href="{{ URL::to( 'incidencias/insertar')}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Nueva incidencia
                        </a>
                    </li>
                </ul>
            </li>
            <!--end insidencias -->
             <!-- begin acta de reunion -->
            <li class="parent ">
                    <a href="{{ URL::to( 'acta/ver');}}">
                        <span class="glyphicon glyphicon-user"></span> ACTA DE REUNIÓN 
                        <span data-toggle="collapse" href="#sub-item-6" class="icon pull-right">
                            <em class="glyphicon glyphicon-s glyphicon-plus"></em>
                        </span> 
                    </a>
                    <ul class="children collapse" id="sub-item-6">
                        
                        <li>
                            <a class="" href="{{ URL::to( 'acta/verc');}}">
                                <span class="glyphicon glyphicon-share-alt"></span>  reuniones
                            </a>
                        </li>
                        
                    </ul>
            </li>


             <!-- end acta de reunion -->

            <!-- //////////////////////////////////// END USER COMISION ORGANIZADORA ////////////////////////////////////-->
            <?php
            }
            else
            {
                if(User::isEquipo())
                {?>
                    <!--//////////////////////////////////// BEGIN USER EQUIPO////////////////////////////////////-->
                    <li><a href="{{URL::to('/fixture/ver')}}"><span class="glyphicon glyphicon-hand-up"></span>funciones del equipo</a></li>
                    <!-- begin jugador -->
                    <li class="parent {{ (Request::is( 'jugador') || Request::is( 'jugador/*')) ? 'active open' : ''}}">
                        <a href="javascript:void(0)">
                            <span class="glyphicon glyphicon-user"></span> Jugador <span data-toggle="collapse" href="#sub-item-sin_j" class="icon pull-right">
            <em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                        </a>
                        <ul class="children collapse" id="sub-item-sin_j">
                            <li>
                                <a class="{{ Request::is( 'jugador/index') ? 'active open' : '' }}" href="{{URL::to('jugador')}}">
                                    <span class="glyphicon glyphicon-list"></span> listar jugador
                                </a>
                            </li>
                            <li>
                                <a class="{{ Request::is( 'jugador/create') ? 'active open' : '' }}" href="{{URL::to('jugador/create')}}">
                                    <span class="glyphicon glyphicon-plus"></span> Agregar jugador
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- en jugador -->
                    <!-- ////////////////////////////////////END USER EQUIPO////////////////////////////////////-->
                <?php
                }
                else
                {
                }
            }
        }?>@endif
</ul>