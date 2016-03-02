@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.arbitro')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/acta/ver');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('Actas de reuniones')
@stop

@section('contenido')

<div class="row col-no-gutter-container row-margin-top">
			<div class="col-lg-12 col-no-gutter">
				<div class="panel panel-default">



  <div class="row">
	
    <div class="col-lg-6">	
			<table class="table">
				<thead>
					<tr>
						<td>idreunion</td>
						<td>fecha</td>
					</tr>
				</thead>
				<tbody>
					@foreach($todoReunion as $cat)
					<tr>
						<td>{{$cat->idreunion}}</td>
						<td>{{$cat->fecha}}</td>
						<?php
						$habilitado="20".date("y-m-d");
						//$a=(string)$habilitado2;
						$anio1=substr($habilitado, 0,4);
						$mes1=substr($habilitado, 5,2);
						$dia1=substr($habilitado, 8,2);
						$anio2=substr($cat->fecha, 0,4);
						$mes2=substr($cat->fecha, 5,2);
						$dia2=substr($cat->fecha, 8,2);
						$difanio=(int)$anio1-(int)$anio2;
						$difmes=(int)$mes1-(int)$mes2;
						$difdia=(int)$dia1-(int)$dia2;
						//echo $difdia;
							$mayor=0;
							if($difanio>=0)
								{
									if($difanio>0)
									{ $mayor=1;}
									else
									{ $mayor=0;}	
								}
							else	
								{
									$mayor=-1;
								}
							if($mayor==0)
								{
									if($difmes>=0)
										{
											if($difmes>0)
												{ $mayor=1;}
											else
												{ $mayor=0;}	
										}
									else	
										{
										$mayor=-1;
										}
								}
							if($mayor==0)
								{
									if($difdia>=0)
									{
										if($difdia>0)
											{ $mayor=1;}
										else
											{ $mayor=0;}	
									}
									else	
									{
										$mayor=-1;
									}

								}			

						

						 ?>

						@if($mayor>=0)
							@if($mayor==0)

							<td>
								<a href="/SCDW/public/acta/verAs/{{$cat->idreunion}}" class="btn btn-default">
								<span class="glyphicon glyphicon-list"></span> ver
								</a>

								<a href="/SCDW/public/acta/verA/{{$cat->idreunion}}" class="btn btn-default">
								<span class="glyphicon glyphicon-edit"></span> editar
								</a>

							
							</td>
							@else
								<td>
						
									<a href="/SCDW/public/acta/verAs/{{$cat->idreunion}}" class="btn btn-default">
									<span class="glyphicon glyphicon-th-list"></span> ver
									</a>
									
								</td>
							@endif   
						@endif	
						
					</tr>
					@endforeach


					{{$todoReunion->links()}}
				</tbody>
			</table>
	</div>
	</div>	
</div>
</div>
</div>

@stop
