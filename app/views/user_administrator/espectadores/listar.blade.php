@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
        <li><a href="{{ URL::to( '/docente/listar');}}">ver docentes</a></li>
	   
@stop

@section('nombrevista')
    @lang('Docentes')
@stop

@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="float: left">LISTA DE DOCENTES</div>
                    <div style="float: right">
                        <div class="form-inline">
                            {{ Form::open(array('url' => 'espectadores/search','method' => 'post')) }}
                            <div class="form-group">

                                <a class="btn btn-default margin text-lowercase" type="button" href="insertar"><span class="glyphicon glyphicon-plus"></span> Add New</a>
                                <label class="label"><span class="glyphicon glyphicon-search"></span></label>
                                <input type="text" class="form-control" name="valor" placeholder="Buscar por Codigo" maxlength="5">
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th >idespectador</th>
                            <th >Nombre</th>
                            <th >nro asientos</th>
                            <th >Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $docentetodo as $docente)
                            <tr>
                                <td>{{$docente->id}}</td>
                                <td>{{$docente->nombre}} </td>
                                <td>{{$docente->nroasiento}} </td>

                                <td>
                                    <a class="label label-primary" href="editar/{{$docente->id}}" ><span class="glyphicon glyphicon-edit"></span> &nbsp;Edit</a>

                                    <a class="label label-danger" href="eliminar/{{ $docente->id}}" ><span class="glyphicon glyphicon-trash"></span> &nbsp;Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $docentetodo->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@stop