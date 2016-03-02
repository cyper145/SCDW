@extends('_templates.apptemp')
@section('titulo')
@lang('Varapp.nombre_sistema_mediano')



@stop
@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/DptoAcademico/listar');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop



@section('nombrevista')
<!--Agregar departamento Academico  
    @lang('Nuevo departamento Academico ')
    -->
@stop

@section('contenido')
  <div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Agregar Departamento Academico</div>
					<div class="panel-body">
						<div class="col-md-6">
							{{ Form::open(array('url' => 'DptoAcademico/formulario1','method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
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

                                <div class="form-group">
                                    <label >Codigo</label>
                                    <input class="form-control" placeholder="codigo de departamento academico" name="codigo" required maxlength="10">
                                </div>
								<div class="form-group">
									<label>Nombre</label>
									<input class="form-control" placeholder="Nombre departamento academico" name="nombre"required>
								</div>
								<div class="form-group">
									<label>Carrera</label>
									<input class="form-control" placeholder="Esccuela profesional" name="carrera" required>
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