@extends('_templates.apptemp')

@section('titulo')
    @lang('gol')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a></li>

@stop

@section('nombrevista')
    @lang('Gol')
@stop

@section('contenido')
    <div class="col-md-6 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">Goles de este jugador
                <div class="panel-tools pull-right">
                    <div class="form-inline">
                        <div class="form-group">
                            <a class="btn btn-info margin text-lowercase" type="button" href="{{URL::to('fechas/detail/partido/gol/'.$idjugadorenjuego.'/'.$idfixture)}}"><span class="glyphicon glyphicon-plus"></span>Agregar gol</a>
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
                                <a class="label label-danger" href="{{URL::to('fechas/detail/partido/gol/eliminar/'.$idjugadorenjuego.'/'.$idfixture.'/'.$val->idgol)}}">
                                    <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a class="btn btn-info" href="{{ URL::to( 'fechas/detail/partido/'.$idfixture);}}">Aceptar</a>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection

