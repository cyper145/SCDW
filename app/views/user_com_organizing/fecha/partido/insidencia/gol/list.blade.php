@extends('_templates.apptemp')

@section('titulo')
    @lang('gol')
@stop

@section('rutanavegacion')
@stop

@section('nombrevista')
    @lang('Gol')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <div class="col-md-7 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">{{$jugador->dataDocente[0]->nombre}} {{$jugador->dataDocente[0]->apellidopaterno}} {{$jugador->dataDocente[0]->apellidomaterno}}
                <div class="panel-tools pull-right">
                    <div class="form-inline">
                        <div class="form-group">
                            <a class="btn btn-info margin text-lowercase" type="button" href="goles/add.html"><span class="glyphicon glyphicon-plus"></span>Agregar gol</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <!-- BEGIN PARA MANEJO DE ERRORES -->
                @include('alerts.allsuccess')
                <!-- END PARA MANEJO DE ERRORES -->
                <table data-toggle="table" data-url="tables/data2.json">
                    <thead>
                    <tr>
                        <th>Minuto</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($golesdeljugadorenjuego as $val)
                        <tr>
                            <td>{{$val->minuto}}</td>
                            <td>
                                <a class="label label-danger" href="{{$val->idgol}}/delete.html">
                                    <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a class="btn btn-info" href="{{ URL::to('fechas/'.$idfecha.'/'.$codcampeonato.'/'.$idtorneo.'/'.$idfixture.'/partido.html');}}">Aceptar</a>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection

