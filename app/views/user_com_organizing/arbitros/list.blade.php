@extends('_templates.apptemp')

@section('titulo')
    @lang('Arbitros')
@stop

@section('rutanavegacion')
    <li><span class="glyphicon glyphicon-tags"></span></li>

@stop

@section('nombrevista')
    @lang('Arbitros')
@stop

@section('contenido')
    <div class="col-md-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">Relacion de todos los arbitros
                <div class="panel-tools pull-right">
                    <div class="form-inline">
                        <div class="form-group">
                            <a class="btn btn-info margin text-lowercase" type="button" href="{{URL::to('Arbitros/insertar.html')}}"><span class="glyphicon glyphicon-plus"></span>Agregar Nuevo Arbitro</a>
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
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Edad</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($arbitros as $val)
                        <tr>
                            <td>{{$val->nombre.' '.$val->Apellidos}}</td>
                            <td>{{$val->dni}}</td>
                            <td>{{$val->edad}}</td>
                            <td>
                                <a class="label label-danger" href="eliminar/{{$val->dni}}">
                                    <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $arbitros->links() }}
                </div>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection

