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
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
     <!--codigo php -->
    <!--fin codigo php -->

    <div class="row col-lg-12">
        <div class="col-lg-12 col-no-gutter">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de: {{$campeonato->nombre}}</div>
                <div class="panel-body">
                    <strong class="primary-font">Nombre: </strong><span class="text-primary">{{$campeonato->nombre}}</span><br>
                    <strong class="primary-font">Año académico: </strong><span class="text-primary">{{$campeonato->anioAcademico}}</span><br>
                    <strong class="primary-font">Fecha de creacion: </strong><span class="text-primary">{{$campeonato->fechaCreacion}}</span><br>
                    <strong class="primary-font">Estado: </strong><span class="text-primary">{{$campeonato->habilitar}}</span><br>
                </div>
                <div class="panel panel-footer">

                    <a class="btn btn-info" href="#equipos">Ver Equipos</a>
                    <a class="btn btn-info" href="#actividades">Actividades</a>
                    <a class="btn btn-info" href="#configuracion">configuracion</a>
                    <a class="btn btn-info" href="#acta">acta de reuniones</a>
                    <div class="panel-tools pull-right">
                        <div class="form-inline">
                            {{ Form::open(['route'=> ['torneo.show',$campeonato->codCampeonato], 'method'=>'get']) }}
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
                <div class="panel-heading">Actividades
                    <div class="panel-tools pull-right">
                        <div class="form-inline">
                            <div class="form-group">
                                <a class="btn btn-info margin text-lowercase" type="button" href="{{$campeonato->codCampeonato}}/actividad.html"><span class="glyphicon glyphicon-plus"></span>Nueva Actividad</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>Actividad</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Observaciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Actividades as $val)
                            <tr>
                                <td>{{$val->actividad}}</td>
                                <td>{{$val->fechaInicio}}</td>
                                <td>{{$val->fechaFin}}</td>
                                <td>{{$val->observaciones}}</td>
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
    <div class="row row-no-gutter col-no-gutter-container" id="configuracion">
            <div class="col-md-12 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">configuracion
                    <div class="panel-tools pull-right">
                        <div class="form-inline">
                            <div class="form-group">
                                <?php
                                $users = DB::table('tconfiguracion')->count();
                                ?>
                                @if($users==0)
                                <a class="btn btn-info margin text-lowercase" type="button" href="{{$campeonato->codCampeonato}}/configuracion.html"><span class="glyphicon glyphicon-plus"></span>Configuracion inicial</a>
                                @else
                                <a class="btn btn-info margin text-lowercase" type="button" href="{{$campeonato->codCampeonato}}/configuracionD.html"><span class="glyphicon glyphicon-plus"></span>Agregar Configuracion</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>descripcion</th>
                            <th>valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($configuracion as $val)
                            <tr>
                                <td>{{$val->descripcion}}</td>
                                <td>{{$val->valor}}</td>
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
    <div class="row row-no-gutter col-no-gutter-container" id="acta">
        <div class="col-md-12 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Acta Reuniones
                    <div class="panel-tools pull-right">
                        <div class="form-inline">
                            <div class="form-group">
                                <a class="btn btn-info margin text-lowercase" type="button" href="{{$campeonato->codCampeonato}}/actadd.html"><span class="glyphicon glyphicon-plus"></span>Nueva reunion</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>codigo Reunion </th>
                            <th>Fecha </th>
                            <th>acciones </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($todoReunion as $val)
                            <tr>
                                <td>{{$val->codReunion}}</td>
                                <td>{{$val->fecha}}</td>

                                <!--codigo php -->
                                <?php
                                $habilitado="20".date("y-m-d");
                                //$a=(string)$habilitado2;
                                $anio1=substr($habilitado, 0,4);
                                $mes1=substr($habilitado, 5,2);
                                $dia1=substr($habilitado, 8,2);
                                $anio2=substr($val->fecha, 0,4);
                                $mes2=substr($val->fecha, 5,2);
                                $dia2=substr($val->fecha, 8,2);
                                $difanio=(int)$anio1-(int)$anio2;
                                $difmes=(int)$mes1-(int)$mes2;
                                $difdia=(int)$dia1-(int)$dia2;
                                //echo $difdia;
                                $mayor=0;
                                if($difanio>=0)
                                {
                                    if($difanio>0)
                                    { $mayor=1;}
                                    else
                                    { $mayor=0;}
                                }
                                else
                                {
                                    $mayor=-1;
                                }
                                if($mayor==0)
                                {
                                    if($difmes>=0)
                                    {
                                        if($difmes>0)
                                        { $mayor=1;}
                                        else
                                        { $mayor=0;}
                                    }
                                    else
                                    {
                                        $mayor=-1;
                                    }
                                }
                                if($mayor==0)
                                {
                                    if($difdia>=0)
                                    {
                                        if($difdia>0)
                                        { $mayor=1;}
                                        else
                                        { $mayor=0;}
                                    }
                                    else
                                    {
                                        $mayor=-1;
                                    }

                                }
                                ?>
                                @if($mayor>=0)
                                    @if($mayor==0)
                                        <td>
                                            <a href="{{$campeonato->codCampeonato}}/actadetalle/{{$val->codReunion}}" class="btn btn-default label label-info">
                                                <span class="glyphicon glyphicon-list"></span> ver
                                            </a>
                                            <a href="{{$campeonato->codCampeonato}}/abriracta/{{$val->codReunion}}" class="btn btn-default label label-info">
                                                <span class="glyphicon glyphicon-edit"></span> editar
                                            </a>

                                        </td>
                                    @else
                                        <td>

                                            <a href="{{$campeonato->codCampeonato}}/actadetalle/{{$val->codReunion}}" class="btn btn-default label label-info">
                                                <span class="glyphicon glyphicon-th-list"></span> ver
                                            </a>

                                        </td>
                                    @endif
                                @endif

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
                                    <a class="label label-success" href="{{$campeonato->codCampeonato}}/equipodetalle/{{$val->codEquipo}}" >
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