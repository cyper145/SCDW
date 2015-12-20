@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li><a href="{{ URL::to('/torneo/'.$codcampeonato);}}">Torneos</a></li>
    <li>Detalle del torneo {{$torneo->tipo}}</li>
@stop

@section('nombrevista')
    @lang('Detalles del Torneo')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de Torneo {{$torneo->tipo}}</div>
            <div class="panel-body">
                <strong class="primary-font">Tipo: </strong><span class="text-primary">Torneo {{$torneo->tipo}}</span><br>
                <strong class="primary-font">Dia de Inicio: </strong><span class="text-primary">{{$torneo->diainicio}}</span><br>
            </div>
            <div class="panel panel-footer">
                <a class="btn btn-warning" href="#fechas">Ver Fechas</a>
                <a class="btn btn-danger" href="#posiciones">Tabla de posiciones</a>
                <a class="btn btn-info" href="#goleadores">Tabla de goleadores</a>
                <a class="btn btn-success" href="#equipos">Ver Equipos</a>
                <a class="btn btn-primary" href="#fixture">Generar Fixture</a>
                <a class="btn btn-primary" href="#fixture">Ver Fixture</a>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="fechas">
        <div class="panel panel-warning">
            <div class="panel-heading">Fechas</div>
            <div class="panel-body color-orange">
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
                                <a class="label label-success" href="{{URL::to( 'fechas/'.$val->idfecha.'/'.$codcampeonato.'/'.$torneo->idtorneo.'/detail.html');}}">
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                </a><br>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a class="btn btn-warning" href="#">Aceptar</a>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="posiciones">
        <div class="panel panel-danger">
            <div class="panel-heading">Tabla de Colocaciones cumplida la 1° fecha</div>
            <div class="panel-body color-orange">
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
            <div class="panel-footer">
                <a class="btn btn-danger" href="#">Aceptar</a>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="goleadores">
        <div class="panel panel-info">
            <div class="panel-heading">Tabla de Goleadores cumplida la 1° fecha</div>
            <div class="panel-body color-orange">
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
            <div class="panel-footer">
                <a class="btn btn-info" href="#">Aceptar</a>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="equipos">
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

    <div class="col-md-12" id="fixture">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Fixtures del torneo {{$torneo->tipo}}</div>
            <div class="panel-body color-orange">
                <!-- aqui se pondra el fixture del torneo -->
            </div>
            <div class="panel-footer">
                <a class="btn btn-primary" href="#">Aceptar</a>
            </div>
        </div>
    </div>

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
    </div>










    <div class="row row-no-gutter col-no-gutter-container">
        <div class="col-md-6 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">otros</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="bar-chart" ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Partidos</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="bar-chart" ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Sancionados</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="radar-chart" ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">otros</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="radar-chart" ></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection