	@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
	<li><span class="glyphicon glyphicon-book"></span></li>
@stop

@section('nombrevista')
    <!--@lang('Home')-->
@stop

@section('contenido')
    <div class="col-md-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">CAMPEONATOS EXISTENTES
                <div class="panel-tools pull-right">
                    <div class="form-inline">
                        <div class="form-group">

                            <a class="btn btn-info margin text-lowercase" type="button" href="{{URL::to('campeonato/insertar')}}"><span class="glyphicon glyphicon-plus"></span> Crear Nuevo Campeonato</a>
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
                        <th>Fecha creacion</th>
                        <th>Reglamento</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($todocampeonato as $camp)
                        <tr>
                            <td>{{$camp->nombre}}</td>
                            <td>{{$camp->fechaCreacion}}</td>
                            <td>{{$camp->reglamento}}</td>
                            <td>
                                <a class="label label-primary" href="editar/{{ $camp->codCampeonato}}">
                                    <span class="glyphicon glyphicon-edit">&nbsp;Edit</span>
                                </a><br>
                                <a class="label label-success" href="detail/{{ $camp->codCampeonato}}" >
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                </a><br>
                                <a class="label label-danger" href="eliminar/{{ $camp->codCampeonato}}">
                                    <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $todocampeonato->links() }}
                </div>
            </div>
        </div>
    </div>
    @section ('scrips')
        <script src="{{asset('/js/bootstrap-table.js')}}"></script>
    @stop
@endsection

