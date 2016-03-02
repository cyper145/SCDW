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
        <div class="col-md-12 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">espectador encontrado</div>
                <div class="panel-body">
                    <div class="col-md-12 col-sm-8">

                        <!-- BEGIN PARA MANEJO DE ERRORES -->
                        @if (count($errors) > 0)
                            <div class="alert bg-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <ul class="error_list">
                                    @foreach ($errors->all() as $error)
                                        <li >
                                            <span class="glyphicon glyphicon glyphicon-check"></span>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                             <!-- END PARA MANEJO DE ERRORES -->

                            <table data-toggle="table" data-url="tables/data2.json">
                                <thead>
                                <tr>
                                    <th >id espectador</th>
                                    <th >Nombre</th>
                                    <th >nro asiento</th>
                                    <th >acciones</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if($docente != "")
                                    <tr>
                                        <td>{{$docente->id}}</td>
                                        <td>{{$docente->nombre}} </td>
                                        <td>{{$docente->nroasiento}} </td>
                                        <td><a href="editar/{{$docente->id}}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a href="eliminar/{{ $docente->id}}" class="btn btn-xs btn-secundary" style="background-color:#900 !important"><i class="glyphicon glyphicon-trash" ></i></a>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@stop