@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li><a href="{{ URL::to('/torneo/'.$codcampeonato);}}">Torneos</a></li>
    <li><a href="{{ URL::to('/torneo/'.$torneo->idtorneo.'/'.$codcampeonato.'/detail.html');}}">Detalle del torneo {{$torneo->tipo}}</a></li>
    <li>Detalle de fecha</li>
@stop

@section('nombrevista')
    @lang('Detalle de fecha del torneo:')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de fecha {{$fecha->nrofecha}}°</div>
            <div class="panel-body">
                <strong class="primary-font">Numero de fecha: </strong><span class="text-primary">{{$fecha->nrofecha}}</span><br>
                <strong class="primary-font">Dia de la fecha: </strong><span class="text-primary">{{$fecha->diafecha}}</span><br>
                <strong class="primary-font">Lugar: </strong><span class="text-primary">{{$fecha->lugar}}</span><br>
            </div>
            <div class="panel panel-footer">
                <a class="btn btn-success" href="#fixture">Ver Fixture</a>
                <div class="pull-right">
                    <a class="btn btn-info" href="{{ URL::to('fecha/edit/'.$codcampeonato.'/'.$torneo->idtorneo);}}">actulizar la fechas</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12" id="fixture">
        <div class="panel panel-success">
            <div class="panel-heading">Fixture de la fecha {{$fecha->nrofecha}}°</div>
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
                                <a class="label label-primary" href="{{$val->idfixture}}/partido.html" >
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
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection