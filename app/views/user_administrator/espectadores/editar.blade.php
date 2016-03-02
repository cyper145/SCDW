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
					<div class="panel-heading">Modificar espectador</div>
					<div class="panel-body">
						<div class="col-md-6">

							  {{ Form::open(array('url' => 'espectador/formulario2/'.$consultatabla->id,'method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
							
								<div class="form-group">
									<label>id espectador</label>
									<input class="form-control" placeholder="codDocente" name="coddocente" value="{{$consultatabla->id}}" readonly="readonly">
								</div>
								<div class="form-group">
									<label>Nombre</label>
									<input class="form-control" placeholder="Nombre" name="nombre" value="{{$consultatabla->nombre}}">
								</div>
								<div class="form-group">
									<label>nro de asiento</label>
									<input class="form-control" placeholder="nro asiento" name="nroasiento" value="{{$consultatabla->nroasiento}}">
								</div>
								<button type="submit" class="btn btn-primary">Guardar</button>
								<button type="reset" class="btn btn-default">Limpiar</button>
							{{ Form::close() }}

							
						</div>
			<!--			</form>
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