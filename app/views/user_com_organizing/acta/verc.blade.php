@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.arbitro')
@stop

@section('rutanavegacion')        

	   
@stop

@section('nombrevista')
    @lang('reunion')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')

<?php 
$pricef = DB::table('tfecha')->max('nroFecha');
$pricer = DB::table('treunion')->count();
//$cod=DB::select('SELECT max(`id`) FROM `treunion` WHERE 1').get();
//$nuevo =(int)$price+1;
$cod="RE0".($pricef).($pricer+1);
//echo $nuevo;
$price2 = DB::table('tfecha')->select('idFecha', 'nroFecha')->get();

$arr=array();
foreach ($price2 as $user)
{
    $arr[$user->idFecha] = "fecha ".$user->nroFecha;
}

?>



<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">


					<div class="panel-heading">
						<h2>Programar reuniones de Fechas</h2>
					</div>	
				<div class="col-lg-3">
			@if(!isset($category))
				{{Form::open(array('method' => 'POST', 'url' => 'campeonato/detail/'.$codcampeonato.'/actaagregar', 'role' => 'form'))}}
				<div class="form-group">

					{{Form::label('idreunion')}}
					{{Form::text('idreunion', $cod, array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('idreunion') }}</span>
				</div>
				<div class="form-group">
					{{ Form::label('fecha')}}
					{{ Form::date('fecha','',array('class' => 'form-control')) }}
					
					<span class="help-block">{{ $errors->first('fecha') }}</span>
				</div>
				<div class="form-group">
					
					{{Form::label('idfecha:')}}
					{{Form::select('idfecha', $arr,'',array('class' => 'form-control'))}}
					
					<span class="help-block">{{ $errors->first('idfecha') }}</span>
				</div>
				<div class="form-group">
					<p>{{Form::submit('Crear Conclusion', array('class' => 'btn btn-default'))}}</p>
				</div>

				{{Form::close()}}
			@else
				{{Form::open(array('method' => 'POST', 'url' => 'campeonato/detail/'.$codcampeonato.'/actaedit/'.$category->codReunion, 'role' => 'form'))}}

				<div class="form-group">
					{{ Form::label('fecha')}}
					{{Form::date('fecha','', array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
				<div class="form-group">
					
					{{Form::label('idfecha')}}
					{{Form::select('idfecha', $arr,'',array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
				
				<div class="form-group">
					<p>{{Form::submit('Modificar conclusion', array('class' => 'btn btn-default'))}}</p>
				</div>

				{{Form::close()}}
			@endif
</div>



<div class="row">
		<div class="col-lg-6">
			<table class="table">
				<thead>
					<tr>
						<td>idreunion</td>
						<td>fecha</td>
						<td>nroAsistentes</td>
					</tr>
				</thead>
				<tbody>
					@foreach($todoConclusion as $cat)
					<tr class="no-records-found">
						<td>{{$cat->codReunion}}</td>
						<td>{{$cat->fecha}}</td>
						<td>
						<?php

						$count = Asistente::where('codReunion', '=', $cat->codReunion)->count();

						?>	
						{{$count}}


						</td>

						<td>

							<a href= "{{ URL::to( 'campeonato/detail/'.$codcampeonato.'/actaedit/'.$cat->codReunion)}}"  class="btn btn-default">
							<span class="glyphicon glyphicon-edit"></span> Editar
							</a>
							<a href= "{{ URL::to( 'campeonato/detail/'.$codcampeonato.'/actadelete/'.$cat->codReunion)}}" class="btn btn-default">
							<span class="glyphicon glyphicon-remove"></span> Eliminar
							</a>
						</td>
						
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
</div>

</div>
</div>
</div>



@stop