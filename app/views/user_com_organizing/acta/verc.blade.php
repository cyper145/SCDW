@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.arbitro')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/acta/verc');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('reunion')
@stop

@section('contenido')

<?php 
$price = DB::table('treunion')->max('idreunion');
//$cod=DB::select('SELECT max(`id`) FROM `treunion` WHERE 1').get();
$nuevo =(int)$price+1;
//echo $nuevo;
$price2 = DB::table('tfechas')->select('nrofecha', 'diafecha')->get();

$arr=array();
foreach ($price2 as $user)
{
    $arr[$user->nrofecha] = $user->diafecha;
}

?>








				

<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">


					<div class="panel-heading">
						<h2>asistencia</h2>	
					</div>	
				<div class="col-lg-3">
			@if(!isset($category))
				{{Form::open(array('method' => 'POST', 'url' => '/acta/verc/add/', 'role' => 'form'))}}

				<div class="form-group">

					{{Form::label('idreunion')}}
					{{Form::text('idreunion', $nuevo, array('class' => 'form-control'))}}
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
				{{Form::open(array('method' => 'POST', 'url' => '/acta/verc/edit/'.$category->idreunion, 'role' => 'form'))}}

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
						<td>{{$cat->idreunion}}</td>
						<td>{{$cat->fecha}}</td>
						<td>
						<?php

						$count = Asistente::where('idreunion', '=', $cat->idreunion)->count();

						?>	
						{{$count}}


						</td>

						<td>

							<a href= "{{ URL::to( '/acta/verc/edit/'.$cat->idreunion);}}"  class="btn btn-default">
							<span class="glyphicon glyphicon-edit"></span> Editar
							</a>
							<a href="/SCDW/public/acta/verc/delete/{{$cat->idreunion}}" class="btn btn-default">
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