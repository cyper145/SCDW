@extends('_templates.apptemp')
@section('titulo')
@lang('Varapp.nombre_sistema_mediano')



@stop
@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/docente/listar');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop



@section('nombrevista')
<!--Agregar docente <small> NUEVO DOCENTE </small>  
    @lang('Nuevo Docente')
    -->
@stop

@section('contenido')
  <div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Agregar Docente</div>
					<div class="panel-body">
						<div class="col-md-6">
							{{ Form::open(array('url' => 'docente/formulario1','method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
								
								<!-- BEGIN PARA MANEJO DE ERRORES -->
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
		                        <!-- END PARA MANEJO DE ERRORES -->

		                        <!-- BEGIN CONTENIDO DEL FORMULARIO -->
								<div class="form-group">
									<label>Codigo de docente</label>
									<input class="form-control" placeholder="11223" name="codigo"  maxlength="6" required>
								</div>
								<div class="form-group">
									<label>Nombre</label>
									<input class="form-control" placeholder="Juan" name="nombre" required>
								</div>
								<div class="form-group">
									<label>Apellido Paterno</label>
									<input class="form-control" placeholder="Perez" name="apellidopaterno" required>
								</div>
								<div class="form-group">
									<label>Apellido Materno</label>
									<input class="form-control" placeholder="Perez" name="apellidomaterno" required>
								</div>
								<div class="form-group">
									<label>Categoria</label>
									<select  class="form-control" name="categoria">
										<option class="form-control" value="nombrado">nombrado</option>
										<option class="form-control" value="contratado">contratado</option>
									</select>
								</div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" placeholder="wil@gmail.com" name="email" required>
                                </div>

								<div class="form-group">
									<label>Departamento Academico</label>
									<select  class="form-control" name="iddepartamento">
									@foreach( $dptotodo as $dpto)
										<option class="form-control" value="{{$dpto->codDptoAcademico}}"> {{$dpto->nombre}} </option>
									@endforeach
									</select>
								</div>
                                <!-- END CONTENIDO DEL FORMULARIO -->

								<button type="submit" class="btn btn-primary">Guardar</button>
								<button type="reset" class="btn btn-default">Limpiar</button>
							
							{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
			</div>
@stop
@section ('scrips')

@stop
@endsection