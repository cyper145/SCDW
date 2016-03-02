@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/DptoAcademico/listar');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('Departamentos Academicos')
@stop

@section('contenido')

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Lista de Departamentos Academicos <div style="float:right"><a class="btn btn-default btn-circle margin" href="insertar"><i class="glyphicon glyphicon-plus"></i>
                        </a></div></div>

							@if (count($errors) > 0)
		                        <div class="alert bg-danger" role="alert">
		                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                            <ul class="error_list">
		                                @foreach ($errors->all() as $error)
		                                <li >
		                                    <span class="glyphicon glyphicon-exclamation-sign"></span>
		                                    {{ $error }}
		                                </li>
		                                @endforeach
		                            </ul>
		                        </div>
		                    @endif

				<div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
						<thead>
						
						<tr>
						        <th>Id Departamento</th>
						        <th>Nombre</th>
						        <th>Carrera</th>
						        <th>Acciones</th>
						    </tr>
						    </thead>
						    <tbody>
							@foreach( $dptotodo as $dpto)
								<tr>
                            	<td>{{$dpto->codDptoAcademico}}</td>
								<td>{{$dpto->nombre}} </td>
								<td>{{$dpto->carrera}} </td>
								<td><a href="{{ URL::to('DptoAcademico/editar')}}/{{$dpto->codDptoAcademico}}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
									<a href="{{ URL::to('DptoAcademico/eliminar')}}/{{ $dpto->codDptoAcademico}}" class="btn btn-xs btn-secundary" style="background-color:#900 !important"><i class="glyphicon glyphicon-trash" ></i></a>
								</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					<div class="box-footer clearfix text-center">
                </div>
            </div>
        </div>
    </div>
</div>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@stop