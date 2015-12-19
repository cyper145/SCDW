@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li><a href="{{ URL::to('campeonato/detail/equipo/'.$codequipo.'/'.$codcampeonato.'/detalle.html');}}">Detalle de equipo</a></li>
    <li>Detalle de Jugador</li>
@stop

@section('nombrevista')
    @lang('Detalle de jugador')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <div class="col-md-8">

        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Detalles de: {{$jugador->dataDocente[0]->nombre.' '.$jugador->dataDocente[0]->apellidopaterno.' '.$jugador->dataDocente[0]->apellidomaterno}}</div>
            <div class="panel-body">
                <div class="col-lg-3">
                    {{ HTML::image('storage/jugador/'.$jugador->foto,'User Image',array('class'=>'img-responsive','style'=>'width: 150px')) }}
                </div>
                <div class="col-lg-7">
                    <br>
                    <strong class="primary-font">DNI: </strong><span class="text-primary">{{$jugador->dataDocente[0]->dni}}</span><br>
                    <strong class="primary-font">Nombre: </strong><span class="text-primary">{{$jugador->dataDocente[0]->nombre.' '.$jugador->dataDocente[0]->apellidopaterno.' '.$jugador->dataDocente[0]->apellidomaterno}}</span><br>
                    <strong class="primary-font">Categoría: </strong><span class="text-primary">{{$jugador->dataDocente[0]->categoria}}</span><br>
                    <strong class="primary-font">Edad: </strong><span class="text-primary">{{$jugador->dataDocente[0]->edad}}</span><br>
                    <strong class="primary-font">Dirección: </strong><span class="text-primary">{{$jugador->dataDocente[0]->direccion}}</span><br>
                    <strong class="primary-font">Email: </strong><span class="text-primary">{{$jugador->dataDocente[0]->email}}</span><br>
                    <strong class="primary-font">Teléfono: </strong><span class="text-primary">{{$jugador->dataDocente[0]->telefono}}</span><br>
                    <strong class="primary-font">Estado: </strong><span class="text-primary">{{$jugador->estado}}</span><br>
                    <strong class="primary-font">Numero de goles en el campeonato: </strong><span class="text-primary"> 2 goles</span><br>
                    <strong class="primary-font ">Tarjetas amarillas: </strong><span class="text-primary"> 0 </span><span style="background-color: #ffff00">&nbsp &nbsp&nbsp</span><br>
                    <strong class="primary-font ">Tarjetas rojas: </strong><span class="text-primary"> 0 </span><span style="background-color: red">&nbsp &nbsp&nbsp</span><br>
                    <strong class="primary-font">Obserbaciones: </strong><span class="text-primary">Sancionado por chistoso</span>
                </div>
            </div>
            <div class="panel-footer">
                <a class="btn btn-info" href="#">Aceptar</a>
                <a class="btn btn-default" href="#">Aceptar</a>
                <a class="btn btn-info" href="#">Ver Equipos</a>
                <a class="btn btn-info" href="#">Aceptar</a>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection