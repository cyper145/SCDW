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
                <div class="panel-heading">busqueda de docente</div>
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
                                    <th >Codigo</th>
                                    <th >Nombre</th>
                                    <th >Categoria</th>

                                    <th >Dpto Academcico</th>
                                    <th >Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($docente != "")
                                    <tr>
                                        <td>{{$docente->codDocente}}</td>
                                        <td>{{$docente->nombre." ".$docente->apellidoP." ".$docente->apellidoM}} </td>
                                        <td>{{$docente->categoria}} </td>
                                        <td>{{$docente->dataDptoAcademico[0]->nombre}}</td>
                                        <td><a href="editar/{{$docente->codDocente}}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a href="eliminar/{{ $docente->codDocente}}" class="btn btn-xs btn-secundary" style="background-color:#900 !important"><i class="glyphicon glyphicon-trash" ></i></a>
                                            <!--{{ $docente->coddocente }} {{ $docente->apellidopaterno }}{{ $docente->apellidomaterno }}{{ $docente->nombre }}{{ $docente->categoria }}{{ $docente->iddepartamente }}</a></td> -->
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