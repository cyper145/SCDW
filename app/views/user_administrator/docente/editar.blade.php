@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop


@section('rutanavegacion')
    <li><a href="{{ URL::to( '/docente/listar');}}">ver docentes</a></li>
	   
@stop

@section('nombrevista')
   <!-- @lang('editar docente') -->
@stop

@section('contenido')
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Modificar Docente</div>
					<div class="panel-body">
						<div class="col-md-6">
						@foreach($consultatabla as $camp)
							  {{ Form::open(array('url' => 'docente/formulario2/'.$camp->codDocente,'method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
							
								<div class="form-group">
									<label>Codigo de docente</label>
									<input class="form-control" placeholder="codDocente" name="coddocente" value="{{$camp->codDocente}}" readonly="readonly">
								</div>
								<div class="form-group">
									<label>Nombre</label>
									<input class="form-control" placeholder="Nombre" name="nombre" value="{{$camp->nombre}}">
								</div>
								<div class="form-group">
									<label>Apellido Paterno</label>
									<input class="form-control" placeholder="Apellido Paterno" name="apellidopaterno" value="{{$camp->apellidoP}}">
								</div>
								<div class="form-group">
									<label>Apellido Materno</label>
									<input class="form-control" placeholder="Apellido Materno" name="apellidomaterno" value="{{$camp->apellidoM}}">
								</div>
								<div class="form-group">
									<label>Categoria</label>
									<select  class="form-control" name="categoria">
										<option class="form-control" value="nombrado">Nombrado</option>
										<option class="form-control" value="contratado">Contratado</option>
									</select>
								</div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" placeholder="wil@gmail.com" name="email" value="{{$camp->email}}" required>
                                </div>
								<div class="form-group">
									<label>Id Departamento Academico</label>
									<select  class="form-control" name="iddepartamento">
									@foreach( $dptotodo as $dpto)
										<option class="form-control" value="{{$dpto->coddptoacademico}}">{{$dpto->coddptoacademico}} {{$dpto->nombre}} </option>
									@endforeach
									</select>
								</div>
								<button type="submit" class="btn btn-primary">Guardar</button>
								<button type="reset" class="btn btn-default">Limpiar</button>
							{{ Form::close() }}
							@endforeach
<!--
							
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->

	</div><!--/.main-->


	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/bootstrap-table.js"></script>

@stop