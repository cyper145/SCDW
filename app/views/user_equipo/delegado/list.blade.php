@extends('_templates.apptemp')

@section('titulo')
    @lang('delegados')
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
            <div class="panel-heading">Relacion de delegados
                <div class="panel-tools pull-right">
                    <div class="form-inline">
                        <div class="form-group">

                            <a class="btn btn-info margin text-lowercase" type="button" href="{{URL::to('delegadoinsertar')}}"><span class="glyphicon glyphicon-plus"></span>Ingresar Nuevo delegado</a>
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
                        <th>estado</th>
                        <th>rol</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jugadores as $val)
                        <tr>
                            <td>{{$val->dataDocente[0]->nombre}} {{$val->dataDocente[0]->apellidoP}} {{$val->dataDocente[0]->apellidoM}}</td>
                            <td>{{$val->dni}}</td>
                            <td>{{$val->estado}}</td>
                            <td>{{$val->rol}}</td>
                            <td>
                                <a class="label label-primary" href="{{URL::to('delegadoedit'.$val->dni)}}">
                                    <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                </a><br>

                                <a class="label label-danger" href="{{URL::to('delegado/'.$val->dni.'/delete/.html')}}">
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
