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

        <li><a href="{{URL::to('tablaposicion/ver.html')}}"><span class="glyphicon glyphicon-stats"></span> Ver Tabla de posiciones</a></li>

        <!-- ////////////////////////////////////END USER NORMAL////////////////////////////////////-->
        
    @else      
        <?php 
        if(User::isAdministrator())
        { ?>
            <!-- //////////////////////////////////// BEGIN USER ADMINISTRADOR ////////////////////////////////////-->

                <!-- begin cuentas de usuarios  -->
                <li class="parent ">
                    <a href="javascript:void(0)">
                        <span class="glyphicon glyphicon-log-in"></span> Usuarios <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
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
                    <span class="glyphicon glyphicon-paperclip"></span>Comision de Justicia<span data-toggle="collapse" href="#sub-item-miembro" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
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
            <!-- begin docente -->
            <li class="parent ">
                <a href="{{ URL::to( 'espectadores/listar');}}">
                    <span class="glyphicon glyphicon-user"></span> espectadores <span data-toggle="collapse" href="#sub-item-espectador" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
                </a>

                <ul class="children collapse" id="sub-item-espectador">
                    <li>
                        <a class="" href="{{ URL::to( 'espectadores/insertar');}}">
                            <span class="glyphicon glyphicon-share-alt"></span> Agregar espectador
                        </a>
                    </li>

                </ul>
            </li>
            <!-- end docente-->
            <!-- begin departamento academico -->
            <li class="parent ">
                <a href="{{ URL::to( 'DptoAcademico/listar');}}">
                    <span class="glyphicon glyphicon-bookmark"></span> Departamento Academico <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
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
            <li><a href="{{URL::to('comision/integrantes/list.html')}}"><span class="glyphicon glyphicon-user"></span> Integrantes</a></li>
            <!-- end integrantes -->
            <!-- begin Arbitro -->
            <li><a href="{{URL::to('Arbitros/list.html')}}"><span class="glyphicon glyphicon-tags"></span> Arbitros</a></li>
            <!-- end Arbitros-->
            <!-- begin campeonato -->
            <li><a href="{{URL::to('campeonato/listar')}}"><span class="glyphicon glyphicon-book"></span> Camponatos</a></li>
            <!-- end campeonato -->
            <!-- begin movimiento -->
            <li><a href="{{URL::to('/movimientos')}}"><span class="glyphicon glyphicon-usd"></span> CAJA</a></li>
            <!-- end movimiento -->
             <!-- begin acta de reunion -->
            <li class="parent ">
                    <a href="{{ URL::to( 'acta/ver');}}">
                        <span class="glyphicon glyphicon-file"></span> ACTA DE REUNIÓN
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
                    <!-- begin jugador -->
                        <li><a href="{{URL::to('equipo/index.html')}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li><a href="{{URL::to('jugador/listar.html')}}"><span class="glyphicon glyphicon-user"></span> Jugadores</a></li>
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