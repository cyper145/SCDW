@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.arbitro')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/acta/verA/');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('Acta de reunion ')
@stop



@section('contenido')
<?php

$asistente=DB::select('select * from tdocente');
$arr=array();
foreach ($asistente as $user)
{
    $arr[$user->coddocente] = $user->nombre." ".$user->apellidopaterno." ".$user->apellidomaterno;
}
$arr2=array();
foreach ($asistente as $user1)
{
    $arr2[$user1->nombre." ".$user1->apellidopaterno." ".$user1->apellidomaterno] = $user1->coddocente;
}
$conclusiones=DB::select('select * from tagenda where idreunion=?',array($buscar));
$arr3=array();
foreach ($conclusiones as $user)
{
    $arr3[$user->nroagenda] = $user->tema;
}
$price = DB::table('tagenda')->max('nroAgenda');
//$cod=DB::select('SELECT max(`id`) FROM `treunion` WHERE 1').get();
$nuevo =(int)$price+1;
$price2= DB::table('tconclusion')->max('nroconclusion');
//$cod=DB::select('SELECT max(`id`) FROM `treunion` WHERE 1').get();
$nuevo2 =(int)$price2+1;


?>
<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-primary">

					<div class="panel-heading">
						<h2>asistencia</h2>
					</div>
					<div class="panel-body">
						<div class="col-md-4">
  
				{{Form::open(array('method' => 'POST', 'url' => '/acta/verA/add1', 'role' => 'form'))}}

				<div class="form-group">
					{{Form::label('codigo')}}
					{{Form::select('codigo', $arr2,'',array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('codigo') }}</span>
				</div>
				<div class="form-group">
					{{ Form::label('nombre')}}
					{{Form::select('nombre', $arr,'',array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('nombre') }}</span>
				</div>
				<div class="form-group">
					{{ Form::label('idreunion')}}
					{{Form::text('idreunion', $buscar,array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('idreunion') }}</span>
				</div>

				<div class="form-group">
					<p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
				</div>

				{{Form::close()}}

						</div>

  						<div class="row">
    					<div class="col-md-4">
    		
			<table class="table">
				<thead>
					<tr>
						<td>codigo docente</td>
						<td>nombre</td>

					</tr>
				</thead>
				<tbody>
					@foreach($todoasistente as $cat)
					<tr>
						<td>{{$cat->id_docente}}</td>
						<td>{{$cat->nombre." ".$cat->apellidopaterno." ".$cat->apellidomaterno}}</td>
						<td>delegado</td>
						<td>
						
								<a href="/SCDW/public/acta/verA/{{$buscar}}/delete1/{{$cat->id_asistente}}" class="btn btn-default">
								<span class="glyphicon glyphicon-remove"></span> Eliminar 
								
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
 </div>





<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">

					<div class="panel-heading">
						<h2>agenda</h2>	
					</div>
                    <div class="panel-body">
						<div class="col-md-4">
	  						{{Form::open(array('method' => 'POST', 'url' => '/acta/verA/add2/', 'role' => 'form'))}}

							<div class="form-group">
							{{Form::label('nroAgenda')}}
							{{Form::text('nroAgenda', $nuevo,array('class' => 'form-control'))}}
							<span class="help-block">{{ $errors->first('nroAgenda') }}</span>
							</div>
							<div class="form-group">
							{{ Form::label('tema')}}
							{{Form::text('tema', '',array('class' => 'form-control'))}}
							<span class="help-block">{{ $errors->first('tema') }}</span>
							</div>
							<div class="form-group">
							{{ Form::label('idreunion')}}
							{{Form::text('idreunion2', $buscar,array('class' => 'form-control'))}}
							<span class="help-block">{{ $errors->first('idreunion2') }}</span>
							</div>			
							<div class="form-group">
							<p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
							</div>

							{{Form::close()}}
						</div>

	  					<div class="row">
	    					<div class="col-md-4">    	
								<table class="table">
									<thead>
										<tr>
											<td>nroAgenda</td>
											<td>tema</td>

										</tr>
									</thead>
									<tbody>
									@foreach($todoAgenda as $cat)
									<tr>
										<td>{{$cat->nroagenda}}</td>
										<td>{{$cat->tema}}</td>						
										<td>

											<a href="/system_championship_wil/public/acta/verA/{{$buscar}}/delete2/{{$cat->nroagenda}}" class="btn btn-default">
											<span class="glyphicon glyphicon-remove"></span> Eliminar 
											
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
   </div>
<?php
$price2= DB::table('tconclusion')->max('nroconclusion');
//$cod=DB::select('SELECT max(`id`) FROM `treunion` WHERE 1').get();
$nuevo2 =(int)$price2+1;

?>

<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">

					<div class="panel-heading">
						<h2>conclusiones</h2>	
					</div>
					<div class="panel-body">
						<div class="col-md-4">
  								{{Form::open(array('method' => 'POST', 'url' => '/acta/verA/add3/', 'role' => 'form'))}}

								<div class="form-group">
									{{Form::label('idconclusion')}}
									{{Form::text('idconclusion', $nuevo2,array('class' => 'form-control'))}}
									<span class="help-block">{{ $errors->first('idconclusion') }}</span>
								</div>
								<div class="form-group">
									{{ Form::label('conclusion')}}
									{{Form::text('conclusion', '',array('class' => 'form-control'))}}
									<span class="help-block">{{ $errors->first('fecha') }}</span>
								</div>
								<div class="form-group">
									{{ Form::label('agenda')}}
									{{Form::select('agenda', $arr3,'',array('class' => 'form-control'))}}
									<span class="help-block">{{ $errors->first('agenda') }}</span>
								</div>
								<div class="form-group">
									{{ Form::label('idreunion')}}
									{{Form::text('idreunion3', $buscar,array('class' => 'form-control'))}}
									<span class="help-block">{{ $errors->first('idreunion3') }}</span>
								</div>			
								<div class="form-group">
									<p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
								</div>

								{{Form::close()}}

						</div>				
  						
    					<div class="col-md-4">
    	
						<table class="table">
							<thead>
								<tr>
									<td>idConclusion</td>
									<td>Conclusion</td>

								</tr>
							</thead>
							<tbody>
								@foreach($todoConclusion as $cat)
								<tr>
									<td>{{$cat->id_conclusion}}</td>
									<td>{{$cat->conclusion}}</td>
									
									<td>
									
											<a href="/system_championship_wil/public/acta/verA/{{$buscar}}/delete3/{{$cat->id_conclusion}}" class="btn btn-default">
											<span class="glyphicon glyphicon-remove"></span> Eliminar 
											
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