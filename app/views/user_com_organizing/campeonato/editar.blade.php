@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop


@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li>Nuevo campeonato</li>
@stop

@section('nombrevista')
    @lang('insertar campeonato')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Modificar campeonato</div>
					<div class="panel-body">
						<div class="col-md-6">
							  {{ Form::open(array('url' => 'campeonato/formulario2/'.$campeonato->codcampeonato,'method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}

								<div class="form-group">
									<label>Codigo</label>
									<input class="form-control" placeholder="Codigo del campeonato" name="Codigo" value="{{$campeonato->codcampeonato}}">
								</div>
								<div class="form-group">
									<label>Nombre</label>
									<input class="form-control" placeholder="Nombre" name="Nombre" value="{{$campeonato->nombre}}">
								</div>
								<div class="form-group">
									<label>Año Academico</label>
									<input class="form-control" placeholder="2015-II" name="Anio" value="{{$campeonato->anioacademico}}">
								</div>

								<div class="form-group">


									<label>Fecha creacion</label>
									<input class="form-control" placeholder="05/05/2015" name="Fecha" value="{{$campeonato->fechacreacion}}">
								</div>


								<div class="form-group">
									<label>Reglamento</label>
									<textarea class="form-control" rows="3" name="reglamento">{{$campeonato->reglamento}}</textarea>
								</div>

								<button type="submit" class="btn btn-primary">Guardar</button>
								<button type="reset" class="btn btn-default">Limpiar</button>
							{{ Form::close() }}


							</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
@stop

