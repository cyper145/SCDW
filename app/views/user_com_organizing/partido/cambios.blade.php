@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.arbitro')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/partido/cambios');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('Home')
@stop

@section('contenido')
 
 <?php
 $price = DB::table('tcambio')->max('idcambio');
//$cod=DB::select('SELECT max(`id`) FROM `treunion` WHERE 1').get();
$nuevo =(int)$price+1; 

$conclusiones=DB::select('select * from tjugadorenjuego');
$arr=array();

foreach ($conclusiones as $user)
{
    $arr[$user->idjugadorenjuego] = $user->nrocamiseta;
}
/*
$hora=localtime();
echo gettype($hora)."<br>";
echo $hora[0]."<br>";
echo $hora[1]."<br>";
echo $hora[2]."<br>";
echo $hora[3]."<br>";
*/
$part=DB::select('select * from tpartido');
$cadena="";
$arr2=array();
foreach ($part as $user)
{
	$idd=$user->codpartido;
	//echo $idd;
    $encuentros=DB::select('call encuentros(?)',array($idd));
    foreach ($encuentros as $key) {
    	$partido=$key->codpartido;
    	$cadena=" vs ".$key->nombreEquipo.$cadena;

    }
    	$longitud=strlen($cadena);
    	$cadena=substr($cadena,4);
    $arr2[$partido]=$cadena;


}
//echo $cadena;
?>
<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">


<div class="col-lg-3">
			@if(!isset($category))
				{{Form::open(array('method' => 'POST', 'url' => '/partido/cambios/add', 'role' => 'form'))}}

				<div class="form-group">
					{{Form::label('idcambios')}}
					{{Form::text('idcambios', $nuevo, array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
				<div class="form-group">
					{{Form::label('entra:')}}
					{{Form::select('entra', $arr,'',array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
				<div class="form-group">
					{{Form::label('sale:')}}
					{{Form::select('sale', $arr,'',array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
				<div class="form-group">
					{{Form::label('minuto')}}
					{{Form::time('minuto','', array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>
				<div class="form-group">
					{{Form::label('partido')}}
					{{Form::select('id_partido', $arr2,'',array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('name') }}</span>
				</div>

				<div class="form-group">
					<p>{{Form::submit('hacer cambios', array('class' => 'btn btn-default'))}}</p>
				</div>

				{{Form::close()}}
			@else
				{{Form::open(array('method' => 'POST', 'url' => '/partido/cambios/edit/'.$category->idcambio, 'role' => 'form'))}}

				
				<div class="form-group">
					{{Form::label('entra:')}}
					{{Form::select('entra', $arr,'',array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('entra') }}</span>
				</div>
				<div class="form-group">
					{{Form::label('sale:')}}
					{{Form::select('sale', $arr,'',array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('sale') }}</span>
				</div>
				<div class="form-group">
					{{Form::label('minuto')}}
					{{Form::time('minuto','', array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('minuto') }}</span>
				</div>
				<div class="form-group">
					{{Form::label('partido')}}
					{{Form::select('id_partido', $arr2,'',array('class' => 'form-control'))}}
					<span class="help-block">{{ $errors->first('id_partido') }}</span>
				</div>

				<div class="form-group">
					<p>{{Form::submit('modificar', array('class' => 'btn btn-default'))}}</p>
				</div>

				{{Form::close()}}
			@endif
		</div>

<div class="row">

		<div class="col-lg-6">
			<h2>cambios </h2>
			<table class="table">
				<thead>
					<tr>
						<td>idcambio</td>
						<td>entra</td>
						<td>sale</td>
						<td>min</td>
						<td>partido</td>
					</tr>
				</thead>
				<tbody>
					@foreach($todoConclusion as $cat)
					<tr>
						<td>{{$cat->idcambio}}</td>

						<td>{{$arr[$cat->idjugadorenjuego1]}}</td>
						<td>{{$arr[$cat->idjugadorenjuego2]}}</td>
						<td>{{$cat->minuto }}</td>
						<td>{{$arr2[$cat->codpartido]}}</td>
						<td>
							<a href="/SCWD/partido/cambios/edit/{{$cat->idcambio}}" class="btn btn-default">
							<span class="glyphicon glyphicon-edit"></span> Editar
							</a>
							<a href="/SCWD//partido/cambios/delete/{{$cat->idcambio}}" class="btn btn-default">
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