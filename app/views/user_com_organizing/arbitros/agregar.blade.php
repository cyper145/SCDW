@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop


@section('rutanavegacion')
	<li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('Insertar Arbitro')
@stop

@section('contenido')
	<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Agregar Arbitro</div>
					<div class="panel-body">
						<div class="col-md-6">
							  {{ Form::open(array('url' => 'arbitros/formulario1','method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
							
								<div class="form-group">
									<label>Codigo</label>
									<input class="form-control" placeholder="Codigo del docente" name="Codigo">
								</div>

								<div class="form-group">
									<label>Nombre</label>
									<input class="form-control" placeholder="Nombre" name="Nombre">
								</div>
								<div class="form-group">
									<label>Categoria</label>
									<input class="form-control" placeholder="1" name="Categoria">
								</div>

								<div class="form-group">
									<label>ID Arbitro por Partido</label>
									<input class="form-control" placeholder="1" name="ID">
								</div>
								<button type="submit" class="btn btn-primary">Guardar</button>
								<button type="reset" class="btn btn-default">Limpiar</button>
							{{ Form::close() }}
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