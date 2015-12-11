@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-adjust"></span></a></li>
@stop

@section('nombrevista')
    @lang('Detalles del Torneo')
@stop

@section('contenido')
    <div class="row col-lg-12">
        <div class="col-lg-12 col-no-gutter">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de Torneo {{$torneo->tipo}}</div>
                <div class="panel-body">
                    <strong class="primary-font">Tipo: </strong><span class="text-primary">Torneo {{$torneo->tipo}}</span><br>
                    <strong class="primary-font">Dia de Inicio: </strong><span class="text-primary">{{$torneo->diainicio}}</span><br>
                </div>
                <div class="panel panel-footer">
                    <a class="btn btn-info" href="#">Ver Equipos</a>
                    <a class="btn btn-info" href="#">verFechas</a>
                    <a class="btn btn-info" href="#">Tabla de goleadores</a>
                    <a class="btn btn-info" href="#">Tabla de posiciones</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-no-gutter col-no-gutter-container" id="actividades">
        <div class="col-md-12 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Fechas</div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>Numero de fecha</th>
                            <th>Dia de ejecucion de la fecha</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fechas as $val)
                            <tr>
                                <td>{{$val->nrofecha}}°fecha</td>
                                <td>{{$val->diafecha}}</td>
                                <td>
                                    <a class="label label-success" href="equipo/detalle/{{ $val->idfecha}}" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                    </a><br>
                                    <a class="label label-success" href="equipo/detalle/{{ $val->idfecha}}" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Fixture
                                    </a><br>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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

        <div class="col-md-6 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">otros</div>
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
        <div class="col-md-6 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">otros</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="radar-chart" ></canvas>
                    </div>
                </div>
            </div>
        </div><!--/.col-->
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
                        @foreach($equipos as $val)
                            <tr>
                                <td>{{$val->codequipo}}</td>
                                <td>{{$val->DataEquipo[0]->nombre}}</td>
                                <td>
                                    {{ HTML::image('storage/equipo/'.$val->DataEquipo[0]->logo,'User Image',array('class'=>'img-responsive','style'=>'width: 50px')) }}
                                </td>
                                <td>{{$val->DataEquipo[0]->fotouniforme}}</td>
                                <td>{{$val->DataEquipo[0]->estado}}</td>
                                <td>
                                    <a class="label label-success" href="equipo/detalle/{{ $val->codequipo}}" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                    </a><br>
                                </td>
                            </tr>
                        @endforeach
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
        <div class="col-xs-6 col-md-3 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Insidencias</div>
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart" id="easypiechart-blue" data-percent="92" ><span class="percent">92%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">goleadores</div>
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart" id="easypiechart-orange" data-percent="65" ><span class="percent">65%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">tabla de posisiones</div>
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart" id="easypiechart-teal" data-percent="56" ><span class="percent">56%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">tabla de goleadores</div>
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection