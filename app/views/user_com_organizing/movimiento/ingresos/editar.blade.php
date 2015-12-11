@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
	<li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a></li>
	   
@stop

@section('nombrevista')

@stop

@section('contenido')
   	
	<!--</div>/.main-->
	<!--
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Forms</h1>
			</div>
		</div>/.row-->
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Modificar Ingreso</div>
					<div class="panel-body">
						<div class="col-md-6">
						@foreach($consultatabla as $camp)
							  {{ Form::open(array('url' => 'ingreso/formulario2/'.$camp->nromovimiento,'method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
							
								<div class="form-group">
									<label>Id Ingreso</label>
									<input class="form-control" placeholder="idingreso" name="idingreso" value="{{$camp->idingreso}}" readonly="readonly">
								</div>
								<div class="form-group">
									<label>Equipo</label>
									<select  class="form-control" name="codequipo">
									@foreach( $todoEquipos as $equi)
										<option class="form-control" value="{{$equi->codequipo}}">{{$equi->codequipo}} {{$equi->nombre}} </option>
									@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Nro Movimiento</label>
									<input class="form-control" placeholder="nromovimiento" name="nromovimiento" value="{{$camp->nromovimiento}}" readonly="readonly">
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