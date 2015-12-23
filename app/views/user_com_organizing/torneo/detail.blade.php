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
                <a class="btn btn-danger" href="#posiciones">Tabla de posiciones</a>
                <a class="btn btn-info" href="#goleadores">Tabla de goleadores</a>
                <a class="btn btn-success" href="#equipos">Ver Equipos</a>
                <a class="btn btn-primary" href="{{ URL::to('torneo/detail/'.$campeonato->codcampeonato.'/'.$torneo->idtorneo.'/fixture.html');}}">Generar Fixture</a>
                <a class="btn btn-primary" href="#fixture">Ver Fixture del {{$torneo->tipo}}</a>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="posiciones">
        <div class="panel panel-danger">
            <div class="panel-heading">Tabla de Colocaciones cumplida la 1° fecha</div>
            <div class="panel-body color-orange">
                {{Form::open(array('method' => 'POST', 'url' => '/torneo/'.$campeonato->codcampeonato.'/'.$torneo->idtorneo.'/detail.html/reportes', 'role' => 'form'))}}

                <div class="form-group">
                    <p>{{Form::submit('PDF', array('class' => 'btn btn-primary'))}}</p>
                </div>

                {{Form::close()}}

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
                        <th>GE</th>
                        <th>DG</th>
                        <th>Puntos</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $nro=1;?>
                    @foreach($tabla as $value)
                        <tr>
                            <td>{{$nro++}}</td>
                            <td>{{$value->equipo}}</td>
                            <td>{{$value->PJ}}</td>
                            <td>{{$value->PG}}</td>
                            <td>{{$value->PE}}</td>
                            <td>{{$value->PP}}</td>
                            <td> {{$value->GF}}</td>
                            <td>{{$value->GE}}</td>
                            <td>{{$value->DG}}</td>
                            <td>{{$value->puntaje}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a class="btn btn-danger" href="#">Aceptar</a>
            </div>
        </div>
    </div>





    <div class="col-md-12" id="fixture">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Fixtures del torneo {{$torneo->tipo}}</div>
            <div class="panel-body color-orange">
                <!-- aqui se pondra el fixture del torneo -->
                   <div class="panel panel-footer">
                <?php
                if($nroequipos % 2!=0)
                    $nroequipos++;
                $nrofechas=$nroequipos-1;
                ?>

                <?php for ($i=0;$i<$nrofechas;$i++){?>
                <?php $fecha=$i+1;?>

                <div class="panel-info" id="{{$fecha}}">
                    <div class="panel-heading">
                        FECHA {{$fecha}}
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{URL::to( 'fechas/'.$codcampeonato.'/'.$torneo->idtorneo.'/'.$fecha.'/detail.html');}}">detalle</a>
                            <a class="btn btn-success" href="{{ URL::to('fecha/edit/'.$campeonato->codcampeonato.'/'.$torneo->idtorneo.'/'.$fecha);}}">Programar dia y hora de la Fecha</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table data-toggle="table" data-url="tables/data1.json">
                            <thead>
                            <tr>
                                <th>primer equipo </th>
                                <th>segundo equipo</th>
                                <th>fecha</th>
                                <th>hora </th>

                            </tr>
                            </thead>
                            <?php $fixturefecha=Fixture::where('idfecha', '=',$fecha )->where('idtorneo','=',$torneo->idtorneo)->get();?>
                            <?php $fixture=Fixtureaux::where('idfecha', '=',$fecha )->where('idtorneo','=',$torneo->idtorneo)->get();?>
                            <tbody>
                            <?php $descansa=0; ?>
                            @foreach($fixture as $value)
                                <?php if($value->equipo1==0){?>
                                <?php $descansa=$value->equipo2;?>
                                <?php }?>
                                <?php if($value->equipo2==0){?>
                                <?php $descansa=$value->equipo1;?>
                                <?php }?>
                            @endforeach

                            @foreach($fixturefecha as $val)
                                <tr>
                                    <td>{{Equipo::find($val->equipo1)->nombre}}</td>
                                    <td>{{Equipo::find($val->equipo2)->nombre}}</td>
                                    <td>{{$val->idfecha}}</td>
                                    <td>{{$val->hora}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table class="table" data-align="table">
                            <thead>
                            @if($descansa!=0)
                                <tr>
                                    <th>
                                        {{ "descansa ".Equipo::find($descansa)->nombre}}
                                    </th>
                                </tr>
                            @endif
                            </thead>
                        </table>
                    </div>

                </div>
                <?php }?>
                    </div>
            </div>
            <div class="panel-footer">
                <a class="btn btn-primary" href="#">Aceptar</a>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection