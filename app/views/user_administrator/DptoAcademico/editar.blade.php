@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop


@section('rutanavegacion')
	<li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a></li>
	   
@stop

@section('nombrevista')
   <!-- @lang('editar departamento academico') -->
@stop

@section('contenido')
  
		<div class="row"> <!--row-->
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Modificar Departamento Academico</div>
					<div class="panel-body">
						<div class="col-md-6">
						@foreach($consultatabla as $camp)
							  {{ Form::open(array('url' => 'DptoAcademico/formulario2/'.$camp->codDptoAcademico,'method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
								<div class="form-group">
									<label>Departamento Academico</label>
									<input class="form-control" placeholder="1234" name="iddepartamento" value="{{$camp->codDptoAcademico}}" readonly="readonly">
								</div>
								<div class="form-group">
									<label>Nombre</label>
									<input class="form-control" placeholder="Nombre" name="nombredpto" value="{{$camp->nombre}}">
								</div>
								<div class="form-group">
									<label>Carrera</label>
									<input class="form-control" placeholder="Carrera" name="carrera" value="{{$camp->carrera}}">
								</div>
                                <div class="form-inline">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="reset" class="btn btn-primary">Default</button>
                                </div>
							{{ Form::close() }}
							@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!--col-lg-12-->
	</div><!--/.row-->
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