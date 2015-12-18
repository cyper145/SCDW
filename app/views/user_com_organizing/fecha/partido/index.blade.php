@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-adjust"></span></a></li>
@stop

@section('nombrevista')
    @lang('Partido: '.$fixture->dataEquipo1[0]->nombre.' vs '.$fixture->dataEquipo2[0]->nombre)
@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allsuccess')
    @include('alerts.errors')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="row col-lg-12">
        <div class="col-lg-12 col-no-gutter">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion del partido </div>
                <div class="panel-body">
                    <strong class="primary-font">Hora de inicio: </strong><span class="text-primary">{{$partido->horainicio}}</span><br>
                    <strong class="primary-font">Hora de finalizacion: </strong><span class="text-primary">{{$partido->horafin}}</span><br>
                    <strong class="primary-font">Tipo de partido: </strong><span class="text-primary">{{$partido->tipopartido}}</span><br>
                    <strong class="primary-font">Observaciones: </strong><span class="text-primary">{{$partido->observacion}}</span><br>
                </div>
                <div class="panel panel-footer">
                    @if($partido->idarbitroporpartido == '')
                        <a class="btn btn-info" href="#addarbitro">Agregar Arbitros de este partido</a>
                    @endif
                        <a class="btn btn-info" href="{{ URL::to( '/home');}}">otros</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-no-gutter col-no-gutter-container" id="actividades">
        <div class="col-md-12 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Fixture</div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>partido</th>
                            <th>hora</th>
                            <th class="text-center"></th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    Descansa:
                </div>
            </div>
        </div>
        <div class="col-md-12 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Tabla de Colocaciones cumplida la 1° fecha</div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>nro</th>
                            <th>Equipos</th>
                            <th>PJ</th>
                            <th>PG</th>
                            <th>PE</th>
                            <th>PP</th>
                            <th>GF</th>
                            <th>DG</th>
                            <th>Puntos</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Tabla de Goleadores cumplida la 1° fecha</div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>Nombre y Apellidos</th>
                            <th>Equipos</th>
                            <th>Goles</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Actividades</div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>Actividad</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Observaciones</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-no-gutter" id="addarbitro">
            <div class="panel panel-default">
                <div class="panel-heading">Selecciones arbitro de este partido</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="bar-chart" ></canvas>
                    </div>
                </div>
            </div>
        </div><!--/.col-->
        <div class="col-md-6 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Partidos</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="bar-chart" ></canvas>
                    </div>
                </div>
            </div>
        </div><!--/.col-->

        <div class="col-md-6 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Sancionados</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="radar-chart" ></canvas>
                    </div>
                </div>
            </div>
        </div><!--/.col-->
        @if($partido->idarbitroporpartido == '')
            <div class="col-md-6 col-no-gutter">
                <div class="panel panel-default">
                    <div class="panel-heading">Ingrese los Arbitros del partido</div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <div class="col-md-12">
                                {{ Form::open(array('url'=>'fechas/detail/partido/arbitros/'.$fixture->idfixture,'autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                                <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                                {{ Form::hidden('codpartido',$partido->codpartido)}}
                                <label>Arbitro Principal</label>
                                <select  class="form-control" name="principal">
                                    @foreach( $arbitros as $val)
                                        <option class="form-control" value="{{$val->dni}}">{{$val->dni}} {{$val->nombre}} {{$val->Apellidos}}</option>
                                    @endforeach
                                </select>
                                <label>Asistente 1</label>
                                <select  class="form-control" name="asistente1">
                                    @foreach( $arbitros as $val)
                                        <option class="form-control" value="{{$val->dni}}">{{$val->dni}} {{$val->nombre}} {{$val->Apellidos}}</option>
                                    @endforeach
                                </select>
                                <label>Asistente 2</label>
                                <select  class="form-control" name="asistente2">
                                    @foreach( $arbitros as $val)
                                        <option class="form-control" value="{{$val->dni}}">{{$val->dni}} {{$val->nombre}} {{$val->Apellidos}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                                {{ Form::close()}}
                                <!-- END CONTENIDO DEL FORMULARIO -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-6 col-no-gutter">
                <div class="panel panel-default">
                    <div class="panel-heading">Arbitros del partido</div>
                    <div class="panel-body">
                        <div class="canvas-wrapper">
                            <div class="col-md-12">
                                <strong class="primary-font">Arbitro Principal:<br> </strong><span class="text-primary">
                                    {{$arbitrosdelpartido->DataArbitroPrincipal[0]->nombre}}
                                    {{$arbitrosdelpartido->DataArbitroPrincipal[0]->Apellidos}}
                                    ({{$arbitrosdelpartido->DataArbitroPrincipal[0]->dni}})
                                    ({{$arbitrosdelpartido->DataArbitroPrincipal[0]->edad}} años)</span><br>
                                <strong class="primary-font">Asistente 1:<br> </strong><span class="text-primary">
                                    {{$arbitrosdelpartido->DataArbitroAsistente1[0]->nombre}}
                                    {{$arbitrosdelpartido->DataArbitroAsistente1[0]->Apellidos}}
                                    ({{$arbitrosdelpartido->DataArbitroAsistente1[0]->dni}})
                                    ({{$arbitrosdelpartido->DataArbitroAsistente1[0]->edad}} años)</span><br>
                                <strong class="primary-font">Asistente 2:<br> </strong><span class="text-primary">
                                    {{$arbitrosdelpartido->DataArbitroAsistente2[0]->nombre}}
                                    {{$arbitrosdelpartido->DataArbitroAsistente2[0]->Apellidos}}
                                    ({{$arbitrosdelpartido->DataArbitroAsistente2[0]->dni}})
                                    ({{$arbitrosdelpartido->DataArbitroAsistente2[0]->edad}} años)</span><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div><!--/.row-->
    <div class="row col-no-gutter-container" id="equipos">
        <div class="col-lg-12 col-no-gutter">
            <div class="panel panel-success">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Lista de equipos de del torneo: apertura</div>
                <div class="panel-body color-orange">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>logo</th>
                            <th>uniforme</th>
                            <th>estado</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success" href="#">Aceptar</a>
                </div>
            </div>
        </div>
    </div><!--/.row-->
    <div class="row col-no-gutter-container">
        <div class="col-xs-6 col-md-2 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Insidencias</div>
                <div class="panel-body easypiechart-panel">
                    hla
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-2 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">goleadores</div>
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-2 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">tabla de posisiones</div>
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-2 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-2 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">tabla de goleadores</div>
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->

    <div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body tabs">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Equipo 1 : {{$fixture->dataEquipo1[0]->nombre}}</a></li>
                        <li><a href="#tab2" data-toggle="tab">Equipo 2 : {{$fixture->dataEquipo2[0]->nombre}}</a></li>
                        <li><a href="#tab3" data-toggle="tab">Goles</a></li>
                        <li><a href="#tab4" data-toggle="tab">Targetas</a></li>
                        <li><a href="#tab5" data-toggle="tab">Cambios</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1">
                            {{ HTML::image('storage/equipo/informatica.png','imagen jugador',['class'=>'img-responsive','style'=>'width: 100px']) }}<br>
                            {{ HTML::image('storage/equipo/agronomia.png','imagen jugador',['class'=>'img-responsive','style'=>'width: 100px']) }}<br>
                            <div class="form_contenido">
                                <div id="step-1">
                                    <div class="row">
                                        <div class="row col-no-gutter-container">
                                            @foreach($Delanteros1 as $delantero)
                                                    <div class="col-xs-6 col-md-2 col-no-gutter">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body easypiechart-panel">
                                                                <div>Delantero</div>
                                                                <div >
                                                                    {{ HTML::image('storage/jugador/avatar.png','imagen jugador',['class'=>'img-responsive','style'=>'width: 50px']) }}
                                                                    {{$delantero->apellidopaterno}}
                                                                    ({{$delantero->nrocamiseta}})
                                                                </div>
                                                                <a class="label label-success" href="detail/{{ $delantero->idjugadorenjuego}}/{{$fixture->idfixture}}" >
                                                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                                                </a><br>
                                                                <a class="label label-primary" href="gol/list/{{ $delantero->idjugadorenjuego}}/{{$fixture->idfixture}}" >
                                                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Gol
                                                                </a><br>
                                                                <a class="label label-warning" href="detail/{{ $delantero->idjugadorenjuego}}/{{$fixture->idfixture}}" >
                                                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Tarjeta
                                                                </a><br>
                                                                <a class="label label-info" href="insidencia/{{ $delantero->idjugadorenjuego}}/{{$fixture->idfixture}}" >
                                                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Insidencia
                                                                </a><br>
                                                                <a class="label label-danger" href="eliminar/{{ $delantero->idjugadorenjuego}}/{{$fixture->idfixture}}">
                                                                    <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="row col-no-gutter-container">
                                            @foreach($Mediocampistas1 as $delantero)
                                                <div class="col-xs-6 col-md-2 col-no-gutter">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body easypiechart-panel">
                                                            <div>Mediocampista</div>
                                                            <div >
                                                                {{ HTML::image('storage/jugador/avatar.png','imagen jugador',['class'=>'img-responsive','style'=>'width: 50px']) }}
                                                                {{$delantero->apellidopaterno}}
                                                                ({{$delantero->nrocamiseta}})
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="row col-no-gutter-container">
                                            @foreach($Defensas1 as $delantero)
                                                <div class="col-xs-6 col-md-2 col-no-gutter">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body easypiechart-panel">
                                                            <div>Defensa</div>
                                                            <div >
                                                                {{ HTML::image('storage/jugador/avatar.png','imagen jugador',['class'=>'img-responsive','style'=>'width: 50px']) }}
                                                                {{$delantero->apellidopaterno}}
                                                                ({{$delantero->nrocamiseta}})
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="row col-no-gutter-container">
                                            @foreach($Guardameta1 as $delantero)
                                                <div class="col-xs-6 col-md-2 col-no-gutter">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body easypiechart-panel">
                                                            <div>Guardameta</div>
                                                            <div >
                                                                {{ HTML::image('storage/jugador/avatar.png','imagen jugador',['class'=>'img-responsive','style'=>'width: 50px']) }}
                                                                {{$delantero->apellidopaterno}}
                                                                ({{$delantero->nrocamiseta}})
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div><br>
                                </div>
                            </div>
                            <div class="panel-body panel-footer">
                                <div id="step-1 ">
                                    <div class="row">
                                        <div class="row col-no-gutter-container">
                                            @foreach($suplentes1 as $delantero)
                                                <div class="col-xs-6 col-md-2 col-no-gutter">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body easypiechart-panel">
                                                            <div>Suplente</div>
                                                            <div >
                                                                {{ HTML::image('storage/jugador/avatar.png','imagen jugador',['class'=>'img-responsive','style'=>'width: 50px']) }}
                                                                {{$delantero->apellidopaterno}}
                                                                ({{$delantero->nrocamiseta}})
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="row col-no-gutter-container">
                                            @foreach($capitan1 as $delantero)
                                                <div class="col-xs-6 col-md-2 col-no-gutter">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body easypiechart-panel">
                                                            <div>Capitan</div>
                                                            <div >
                                                                {{ HTML::image('storage/jugador/avatar.png','imagen jugador',['class'=>'img-responsive','style'=>'width: 50px']) }}
                                                                {{$delantero->apellidopaterno}}
                                                                ({{$delantero->nrocamiseta}})
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div><br>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="col-md-3">
                                    {{ Form::open(array('url'=>'fechas/detail/partido/jugador/add/'.$fixture->idfixture,'autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                                    {{ Form::hidden('codpartido',$partido->codpartido) }}
                                    <div class="form-group">
                                        {{ Form::label('dni', 'Jugador',array("class"=>"control-label")) }}
                                        <select  class="form-control" name="jugador">
                                            @foreach( $jugadoresequipo1 as $val)
                                                <option class="form-control" value="{{$val->idjugador}}">{{$val->dataDocente[0]->apellidopaterno}} {{$val->dataDocente[0]->apellidomaterno}} {{$val->dataDocente[0]->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('dni', 'Condicion',array("class"=>"control-label")) }}
                                        <select  class="form-control" name="condicion">
                                                <option class="form-control" value="delantero">Delantero</option>
                                                <option class="form-control" value="mediocampista">Mediocampista</option>
                                                <option class="form-control" value="guardameta">Guardameta</option>
                                                <option class="form-control" value="defensa">Defensa</option>
                                                <option class="form-control" value="suplente">Suplente</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('dni', 'Camiseta',array("class"=>"control-label")) }}
                                        {{ Form::text('camiseta',null,["class"=>"required form-control","maxlength"=>"2"]) }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {{ Form::label('dni', 'Es campitan?',array("class"=>"control-label")) }}
                                        <select  class="form-control" name="escapitan">
                                            <option class="form-control" value="no">No</option>
                                            <option class="form-control" value="si">Si</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group"><br>
                                        {{ Form::submit('Agregar',['class' => 'btn btn-primary'])}}
                                    </div>
                                </div>
                                {{ Form::close()}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <h4>Equipo 2 : {{$fixture->dataEquipo2[0]->nombre}}</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget rutrum purus. Donec hendrerit ante ac metus sagittis elementum. Mauris feugiat nisl sit amet neque luctus, a tincidunt odio auctor. </p>
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            <h4>Tab 3</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget rutrum purus. Donec hendrerit ante ac metus sagittis elementum. Mauris feugiat nisl sit amet neque luctus, a tincidunt odio auctor. </p>
                        </div>
                        <div class="tab-pane fade" id="tab4">
                            <h4>Tab 3</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget rutrum purus. Donec hendrerit ante ac metus sagittis elementum. Mauris feugiat nisl sit amet neque luctus, a tincidunt odio auctor. </p>
                        </div>
                        <div class="tab-pane fade" id="tab5">
                            <h4>Tab 3</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget rutrum purus. Donec hendrerit ante ac metus sagittis elementum. Mauris feugiat nisl sit amet neque luctus, a tincidunt odio auctor. </p>
                        </div>
                    </div>
                </div>
            </div><!--/.panel-->
        </div><!--/.col-->
    </div>

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection