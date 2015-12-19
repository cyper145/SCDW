@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li>Detalle de equipo</li>
@stop

@section('nombrevista')
    @lang('Detalles de equipo')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <div class="col-md-7">

        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Detalles de: {{$equipo->nombre}}</div>
            <div class="panel-body">
                <strong class="primary-font">Nombre: </strong><span class="text-primary">{{$equipo->nombre}}</span><br>
            </div>
            <div class="panel-footer">
                <a class="btn btn-info" href="#">Aceptar</a>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Relacion de Jugadores</div>
            <div class="panel-body color-orange">
                <table data-toggle="table" data-url="tables/data2.json">
                    <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Foto</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jugadoresdelequipo as $val)
                        <tr>
                            <td>{{$val->dataDocente[0]->coddocente}}</td>
                            <td>{{$val->dataDocente[0]->nombre.' '.$val->dataDocente[0]->apellidopaterno.' '.$val->dataDocente[0]->apellidomaterno}}</td>
                            <td>{{$val->estado}}</td>
                            <td>
                                {{ HTML::image('storage/jugador/'.$val->foto,'User Image',array('class'=>'img-responsive','style'=>'width: 50px')) }}
                            </td>
                            <td>
                                <a class="label label-success" href="jugador/{{ $val->idjugador}}/detail.html" >
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                </a><br>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a class="btn btn-info" href="#">Aceptar</a>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection