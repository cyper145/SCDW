@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li><a href="{{ URL::to('/torneo/'.$codcampeonato);}}">Torneos</a></li>
    <li><a href="{{ URL::to('/torneo/'.$torneo->codRueda.'/'.$codcampeonato.'/detail.html');}}">Detalle del torneo {{$torneo->tipo}}</a></li>
    <li>Detalle de fecha</li>
@stop

@section('nombrevista')
    @lang('Detalle de fecha del torneo:')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de fecha {{$fecha->nroFecha}}°</div>
            <div class="panel-body">
                <strong class="primary-font">Numero de fecha: </strong><span class="text-primary">{{$fecha->nroFecha}}</span><br>
                <strong class="primary-font">Dia de la fecha: </strong><span class="text-primary">{{$fecha->diaFecha}}</span><br>

            </div>
            <div class="panel panel-footer">
                <a class="btn btn-success" href="#fixture">Ver Fixture</a>
            </div>
        </div>
    </div>


    <?php

    $fechaactual=DB::select("select curdate() as fecha");
    $fechasiguiente=DB::select("select  adddate(curdate(),1) as fecha");
    $fechaAnterior=DB::select("select  subdate(curdate(),1) as fecha");
    $hora=DB::select("select  curtime() as hora");


    foreach($fechaactual as $value)
    {echo $actual=$value->fecha."<br>";}

    foreach($fechasiguiente as $value)
    {echo $siguiente=$value->fecha."<br>";}

    foreach($hora as $value)
    {echo $horaA=$value->hora."<br>";}

    foreach($fechaAnterior as $value)
    {echo $antes=$value->fecha."<br>";}
$pr






    ?>
    <div class="col-md-12" id="fixture">
        <div class="panel panel-success">
            <div class="panel-heading">Fixture de la fecha {{$fecha->nroFecha}}°</div>
            <div class="panel-body">
                <table data-toggle="table" data-url="tables/data2.json">
                    <thead>
                    <tr>
                        <th>partido</th>
                        <th>hora</th>
                        <th class="text-center">{{$fecha->diaFecha}}</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fixture as $val)
                        <tr>
                            <td>{{$val->nroPartido}}</td>
                            <td>{{$val->hora}}</td>
                            <td class="text-center">{{Equipo::find($val->codEquipo1)->nombre.' <----> '.Equipo::find($val->codEquipo2)->nombre}}</td>
                            <td>
                                <!--- encontrar cod de partido   -->
                                <?php
                                $programacion=Programacion::where('idFecha','=',$fecha->idFecha)->where('nroPartido','=',$val->nroPartido)->first();
                                $partido=Partido::where('codProgramacion','=',$programacion->codProgramacion)->first();
                                $fixture=Fixture::where('codRueda','=',$torneo->codRueda)
                                        ->where('nroFecha','=',$fecha->nroFecha)
                                        ->where('nroPartido','=',$val->nroPartido)->first();
                                ?>

                                <br>
                                <a class="label label-primary" href="{{$partido->codPartido}}/partido.html" >
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Partido
                                </a><br>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                @if($equipoquedescansa !='')
                    Descansa: {{$equipoquedescansa->nombre}}
                @endif
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection