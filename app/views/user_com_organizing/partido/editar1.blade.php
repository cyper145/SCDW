@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.partido')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/partido/listar');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('contenido')
	<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
					<div class="panel-heading">Editar Partido</div>
					<div class="panel-body">
						<div class="col-md-6">
						@foreach($todopartido as $camp)
							  {{ Form::open(array('url' => 'partido/formulario2/'.$camp->codpartido,'method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
							
								<div class="form-group">
									<label>Cod_partido</label>
									<input class="form-control" placeholder="cod.partido" name="Cod_partido" value="{{$camp->codpartido}}">
								</div>
								<div class="form-group">
									<label>Hora_ini</label>
									<input class="form-control" placeholder="h-ini" name="Hora_ini" value="{{$camp->horainicio}}">
								</div>
								<div class="form-group">
									<label>Hora_final</label>
									<input class="form-control" placeholder="h_fin" name="Hora_final" value="{{$camp->horafin}}">
								</div>
								<div class="form-group">
									<label>Tipo de Partido</label>
									<input class="form-control" placeholder="tipo_partido" name="Tipo_partido" value="{{$camp->tipopartido}}">
								</div>
								<div class="form-group">
									<label>Observacion</label>
									<input class="form-control" placeholder="observ" name="Observacion" value="{{$camp->Observacion}}">
								</div>
								<div class="form-group">
									<label>Codigo de programacion</label>
									<input class="form-control" placeholder="cod_programacion" name="Cod_programaacion" value="{{$camp->codprogramacion}}">
								</div>
								<div class="form-group">
									<label>Id del arbitro</label>
									<input class="form-control" placeholder="idarbitro" name="Id_arbitro" value="{{$camp->idarbitroporpartido}}">
								</div>

								

									
								<!--<div class="form-group">
									<label>Reglamento</label>
									<textarea class="form-control" rows="3" name="reglamento">{{$camp->reglamento}}</textarea>
								</div>-->

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