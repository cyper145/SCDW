@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li>Torneos</li>
@stop

@section('nombrevista')
    @lang('Torneos')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <div class="col-md-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">Torneos del Campeonato (fases o ruedas)
                <div class="panel-tools pull-right">
                    <div class="form-inline">
                        <div class="form-group">
                            <a class="btn btn-danger margin text-lowercase text-capitalize" type="button" href="#"><span class="glyphicon glyphicon-list-alt"></span>PDF</a>
                            <a class="btn btn-info margin text-lowercase" type="button" href="{{ URL::to('/torneo/create');}}/{{$codcampeonato}}"><span class="glyphicon glyphicon-plus"></span> Crear Nuevo Torneo</a>
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
                        <th>Tipo</th>
                        <th>Dia Inicio</th>
                        <th>Numero de fechas</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($torneos as $torneo)
                        <tr>
                            <td>{{$torneo->tipo}}</td>
                            <td>{{$torneo->diainicio}}</td>
                            <td>{{$torneo->nrofechas}}</td>
                            <td>
                                <a class="label label-primary" href="editar/{{ $torneo->idtorneo}}">
                                    <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                </a><br>
                                <a class="label label-success" href="{{ URL::to('torneo/');}}/{{$torneo->idtorneo}}/{{$codcampeonato}}/detail.html" >
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                </a><br>
                                <a class="label label-danger" href="{{ URL::to('torneo/delete/');}}/{{$torneo->idtorneo}}/{{$codcampeonato}}">
                                    <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection