@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li><a href="{{ URL::to('/torneo/'.$codcampeonato);}}">Torneos</a></li>
    <li>Detalle del torneo {{$torneo->nombre}}</li>
@stop

@section('nombrevista')
    @lang('Detalles del Torneo')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de Torneo {{$torneo->nombre}}</div>
            <div class="panel-body">
                <strong class="primary-font">Tipo: </strong><span class="text-primary">Torneo {{$torneo->nombre}}</span><br>
                <strong class="primary-font">Dia de Inicio: </strong><span class="text-primary">{{$torneo->fechaCreacion}}</span><br>
            </div>
            <div class="panel panel-footer">
                <a class="btn btn-danger" href="#posiciones">Tabla de posiciones</a>

                <?php $fixturefechaexiste=Fixture::where('codRueda','=',$torneo->codRueda)->first();?>
                @if($fixturefechaexiste == '')
                    <a class="btn btn-primary" href="{{ URL::to('torneo/detail/'.$codcampeonato.'/'.$torneo->codRueda.'/fixture.html');}}">Generar Fixture</a>
                @endif


                <a class="btn btn-primary" href="#fixture">Ver Fixture del {{$torneo->nombre}}</a>
                {{Form::open(array('method' => 'POST', 'url' => '/torneo/'.$codcampeonato.'/'.$torneo->codRueda.'/agregarE', 'role' => 'form'))}}

                <div class="form-group">
                    <p>{{Form::submit('agregar equipos a torneo', array('class' => 'btn btn-primary'))}}</p>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>

    <!--============= tabla de posiciones  buscararchivo tabla150216.txt ==================== -->
    <!--============= endtabla de posiciones    -->




    <div class="col-md-12" id="fixture">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Fixtures del torneo {{$torneo->nombre}}</div>
            <div class="panel-body color-orange">
                <!-- aqui se pondra el fixture del torneo -->
                <div class="panel panel-footer">
                    <?php
                    $nroPartido=0;
                    $nroPartido=(int)($nroequipos/2);
                    if($nroequipos % 2!=0)
                        $nroequipos++;
                    $nrofechas=$nroequipos-1;
                    ?>

                    <?php for ($i=0;$i<$nrofechas;$i++){?>
                    <?php $fecha=$i+1;?>

                    <div class="panel-info">
                        <div class="panel-heading">
                            FECHA {{$fecha}}
                            <div class="pull-right">

                                <?php $fechaexiste = Fechas::where('nroFecha', '=',$fecha )->where('codRueda','=',$torneo->codRueda)->first();?>
                                @if($fechaexiste != '')
                                        <?php  $programacionexiste=Programacion::where('idFecha', '=',$fechaexiste->idFecha)->first();
                                        $programacionro=Programacion::where('idFecha', '=',$fechaexiste->idFecha)->count();
                                        ?>
                                    @if($programacionexiste != '' && $programacionro==$nroPartido)


                                                <a class="btn btn-success" href="{{URL::to( 'fechas/'.$codcampeonato.'/'.$torneo->codRueda.'/'.$fechaexiste->idFecha.'/detail.html');}}">detalle</a>

                                            @else
                                                <a class="btn btn-warning" href="{{ URL::to('fecha/edit/'.$codcampeonato.'/'.$torneo->codRueda.'/'.$fecha);}}">programacion</a>
                                            @endif
                                @else

                                    <a class="btn btn-success" href="{{ URL::to('fecha/edit/'.$codcampeonato.'/'.$torneo->codRueda.'/'.$fecha);}}">Programar dia y hora de la Fecha</a>
                                @endif


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
                                <?php $fixturefecha=Fixture::where('nroFecha', '=',$fecha )->where('codRueda','=',$torneo->codRueda)->get();?>
                                <?php $fixture2=Fixtureaux::where('nroFecha', '=',$fecha )->where('codRueda','=',$torneo->codRueda)->get();?>
                                <tbody>
                                <?php $descansa=""; ?>
                                @foreach($fixture2 as $value)
                                    <?php if($value->codEquipo1==""){?>
                                    <?php $descansa=$value->codEquipo2;?>
                                    <?php }?>
                                    <?php if($value->codEquipo2==""){?>
                                    <?php $descansa=$value->codEquipo1;?>
                                    <?php }?>
                                @endforeach

                                @foreach($fixturefecha as $val)
                                    <tr>
                                        <td>{{Equipo::find($val->codEquipo1)->nombre}}</td>
                                        <td>{{Equipo::find($val->codEquipo2)->nombre}}</td>
                                        <td>{{$val->nroFecha}}</td>
                                        <td>{{$val->hora}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table" data-align="table">
                                <thead>
                                @if($descansa!="")
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