@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li>{{ HTML::link('jugador/listar.html','Relacion de jugadores')}} </li>
    <li>detalle jugador</li>
@stop

@section('nombrevista')
    @lang('Detalles de jugador')
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
                    <strong class="primary-font">DNI: </strong><span class="text-primary">{{$jugador->dni}}</span><br>
                    <strong class="primary-font">Nombre: </strong><span class="text-primary">{{$jugador->dataDocente[0]->nombre.' '.$jugador->dataDocente[0]->apellidoP.' '.$jugador->dataDocente[0]->apellidoM}}</span><br>
                    <strong class="primary-font">Categoría: </strong><span class="text-primary">{{$jugador->dataDocente[0]->categoria}}</span><br>
                    <strong class="primary-font">Edad: </strong><span class="text-primary">{{$jugador->edad}}</span><br>
                    <strong class="primary-font">Dirección: </strong><span class="text-primary">{{$jugador->direccion}}</span><br>
                    <strong class="primary-font">Email: </strong><span class="text-primary">{{$jugador->dataDocente[0]->email}}</span><br>
                    <strong class="primary-font">Teléfono: </strong><span class="text-primary">{{$jugador->telefono}}</span><br>
                    <strong class="primary-font">Estado: </strong><span class="text-primary">{{$jugador->estado}}</span><br>
                    <strong class="primary-font">Numero de goles en el campeonato: </strong><span class="text-primary"> 2 goles</span><br>
                    <strong class="primary-font ">Tarjetas amarillas: </strong><span class="text-primary"> 0 </span><span style="background-color: #ffff00">&nbsp &nbsp&nbsp</span><br>
                    <strong class="primary-font ">Tarjetas rojas: </strong><span class="text-primary"> 0 </span><span style="background-color: red">&nbsp &nbsp&nbsp</span><br>
                    <strong class="primary-font">Obserbaciones: </strong><span class="text-primary">Sancionado por chistoso</span>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success" onclick="history.back()">Aceptar</button>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection