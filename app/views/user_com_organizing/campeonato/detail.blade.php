@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li>Detalle de Campeonato</li>
@stop

@section('nombrevista')
    @lang('Detalles del campeonato')
@stop

@section('contenido')
    <div class="row col-lg-12">
        <div class="col-lg-12 col-no-gutter">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de: {{$campeonato->nombre}}</div>
                <div class="panel-body">
                    <strong class="primary-font">Nombre: </strong><span class="text-primary">{{$campeonato->nombre}}</span><br>
                    <strong class="primary-font">Año académico: </strong><span class="text-primary">{{$campeonato->anioacademico}}</span><br>
                    <strong class="primary-font">Fecha de creacion: </strong><span class="text-primary">{{$campeonato->fechacreacion}}</span><br>
                    <strong class="primary-font">Estado: </strong><span class="text-primary">{{$campeonato->estado}}</span><br>
                </div>
                <div class="panel panel-footer">
                    <a class="btn btn-info" href="#">Bases del campeonato</a>
                    <a class="btn btn-info" href="#equipos">Ver Equipos</a>
                    <a class="btn btn-info" href="#actividades">Actividades</a>
                    <div class="panel-tools pull-right">
                        <div class="form-inline">
                            {{ Form::open(['route'=> ['torneo.show',$campeonato->codcampeonato], 'method'=>'get']) }}
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Torneos</button>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row row-no-gutter col-no-gutter-container" id="actividades">
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
                        @foreach($Actividades as $val)
                            <tr>
                                <td>{{$val->actividad}}</td>
                                <td>{{$val->fechainicio}}</td>
                                <td>{{$val->fechafin}}</td>
                                <td>{{$val->observaciones}}</td>
                                <td>
                                    <a class="label label-success" href="jugador/detail/{{ $val->nroactividad}}" >
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
    </div>
    <br>
    <div class="row col-no-gutter-container" id="equipos">
        <div class="col-lg-12 col-no-gutter">
            <div class="panel panel-success">
                <div class="panel-heading" style="line-height: 20px">EQUIPOS INSCRITOS EN: {{$campeonato->nombre}}</div>
                <div class="panel-body color-orange">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>logo</th>
                            <th>Estado</th>
                            <th>Uniforme(Camiseta)</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($equipos as $val)
                            <tr>
                                <td>{{$val->nombre}}</td>
                                <td>
                                    {{ HTML::image('storage/equipo/'.$val->logo,'Logo empty',array('class'=>'img-responsive','title'=>'logo del equipo','style'=>'width: 50px'))}}
                                </td>
                                <td>{{$val->estado}}</td>
                                <td>
                                    {{ HTML::image('storage/equipo/camiseta/'.$val->fotouniforme,'Uniforme empty',array('class'=>'img-responsive','title'=>'Uniforme del equipo','style'=>'width: 50px')) }}
                                </td>
                                <td>
                                    <a class="label label-success" href="equipo/{{ $val->codequipo}}/{{$campeonato->codcampeonato}}/detalle.html" >
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
    </div>

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection