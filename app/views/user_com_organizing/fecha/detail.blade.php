@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-adjust"></span></a></li>
@stop

@section('nombrevista')
    @lang('Detalle de fecha del torneo:')
@stop

@section('contenido')
    <div class="row col-lg-12">
        <div class="col-lg-12 col-no-gutter">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de fecha {{$fecha->nrofecha}}</div>
                <div class="panel-body">
                    <strong class="primary-font">Numero de fecha: </strong><span class="text-primary">{{$fecha->nrofecha}}</span><br>
                    <strong class="primary-font">Dia de la fecha: </strong><span class="text-primary">{{$fecha->diafecha}}</span><br>
                    <strong class="primary-font">Lugar: </strong><span class="text-primary">{{$fecha->lugar}}</span><br>
                </div>
                <div class="panel panel-footer">
                    <a class="btn btn-info" href="#">Ver Fixture</a>
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
                            <th class="text-center">{{$fecha->diafecha}}</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fixture as $val)
                            <tr>
                                <td>{{$val->nropartido}}°</td>
                                <td>{{$val->hora}}</td>
                                <td class="text-center">{{$val->dataEquipo1[0]->nombre.' <----> '.$val->dataEquipo2[0]->nombre}}</td>
                                <td>
                                    <a class="label label-success" href="{{ URL::to( 'fechas/detail/'.$val->idfecha);}}">
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                    </a><br>
                                    <a class="label label-primary" href="partido/{{ $val->idfixture}}" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Partido
                                    </a><br>
                                </td>
                            </tr>
                        @endforeach
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