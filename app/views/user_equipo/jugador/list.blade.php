@extends('_templates.apptemp')

@section('titulo')
    @lang('Jugadores')
@stop

@section('rutanavegacion')
    <li>Relacion de jugadores</li>
@stop

@section('nombrevista')
    @lang('Jugadores')

@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allsuccess')
    @include('alerts.success')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="col-md-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">Relacion de jugadores
                <div class="panel-tools pull-right">
                    <div class="form-inline">
                        <div class="form-group">

                            <a class="btn btn-info margin text-lowercase" type="button" href="{{URL::to('jugadorinsertar')}}"><span class="glyphicon glyphicon-plus"></span>Ingresar Nuevo jugador</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table data-toggle="table" data-url="tables/data2.json">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>foto</th>
                        <th>estado</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jugadores as $val)
                        <tr>
                            <td>{{$val->dataDocente[0]->nombre}} {{$val->dataDocente[0]->apellidoP}} {{$val->dataDocente[0]->apellidoM}}</td>
                            <td>{{$val->dni}}</td>
                            <td>{{ HTML::image('storage/jugador/'.$val->foto,'imagen jugador',['class'=>'img-responsive','style'=>'width: 70px']) }}</td>
                            <td>{{$val->estado}}</td>
                            <td>
                                <a class="label label-primary" href="{{URL::to('jugadoredit'.$val->dni)}}">
                                    <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                </a><br>
                                <a class="label label-success" href="{{URL::to('jugador/'.$val->dni.'/detail/.html')}}" >
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                </a><br>
                                <a class="label label-danger" href="{{URL::to('jugador/'.$val->dni.'/delete/.html')}}">
                                    <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection
