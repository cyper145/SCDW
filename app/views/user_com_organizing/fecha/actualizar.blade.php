@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
	<li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('actualizar las fechas')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop
@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allerrors')
    @include('alerts.errors')
    <!-- END PARA MANEJO DE ERRORES -->
    	<div class="row col-no-gutter-container">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">actualizar Fechas</div>
					<div class="panel-body">
						<div class="col-md-6">
							  {{ Form::open(array('url' => 'fecha/edit/'.$idcampeonato.'/'.$idtorneo.'/add','method' => 'post', 'files' => true, 'class' => 'form-inline')) }}
                            {{Form::hidden('nrofecha',$nrofecha)}}
                            <div class="form-group">
                                {{ Form::label('fecha')}}
                                {{ Form::text('fecha', null, array('type' => 'text','required', 'class' => 'form-control datepicker','readonly','placeholder' => '2015-12-21', 'id' => 'calendar')) }}
                                <span class="help-block">{{ $errors->first('fecha') }}</span>
                            </div>
                            <div class="form-group">
                                {{ Form::label('hora inicio')}}
                                {{Form::time('horainicio','',array('class' => 'form-control','required','placeholder' => 'hh:mm:ss'))}}
                                <span class="help-block">{{ $errors->first('horainicio') }}</span>
                            </div>
                            <div class="form-group">
                                {{ Form::label('lugar')}}
                                {{Form::text('lugar','',array('class' => 'form-control','required','placeholder' => 'estadio universitario'))}}
                                <span class="help-block">{{ $errors->first('lugar') }}</span>
                            </div>
                            <div class="row">
                            <div class="form-group">
                                <p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
                            </div>
                            </div>
							{{ Form::close() }}
							</div>

					</div>
				</div>
			</div>
        </div>
@stop