@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.arbitro')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/acta/verA');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('Acta de reunion')
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
				<div class="panel panel-default">





					<div class="panel-heading">
						<h2>asistencia</h2>	
					</div>			
  <div class="row">
    <div class="col-lg-6">
    		
			<table class="table table-hover">
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
					</tr>
					@endforeach
				</tbody>
			</table>
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
  <div class="row">
    <div class="col-lg-6">
    	
			<table class="table table-hover">
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
						
					</tr>
					@endforeach
				</tbody>
			</table>
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
  
 
 
  <div class="row">
    <div class="col-lg-6">
    	
			<table class="table table-hover">
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