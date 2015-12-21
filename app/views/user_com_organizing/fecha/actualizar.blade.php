@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
	<li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('actualizar las fechas')
@stop
<?php

$tempfixture1=$fixture;
$tempfxture2=$fixture;
$arr1=array();
$arr2=array();
$idtorneo=$torneo->idtorneo;
$idcampeonato=$campeonato->codcampeonato;
$cod="";
$Cfecha=new FechasController();
foreach ($fixture as $user)
{
    $nro=$user->idfecha;
    $cod=$Cfecha->generrar($nro,$idcampeonato,$idtorneo);
    $cadena=$nro." - ".$cod;
    if(!Fechas::find($cod))
      $arr1[$cadena] =$nro." - ".$cod;
}
foreach ($tempfixture1 as $user)
{
    $nro=(String)$user->idfecha;
    $cod=$Cfecha->generrar($nro,$idcampeonato,$idtorneo);
    if(!Fechas::find($cod))
     $arr2[$nro] = $cod." - ".$nro;
}

?>
@section('contenido')
    <div class="row col-no-gutter-container">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">opciones</div>
                <div class="panel-body">
                    <div class="panel panel-footer" id="fecha">
                        <a class="btn btn-info" href={{"/SCDW/public/torneo/detail/".$campeonato->codcampeonato."/".$torneo->idtorneo}}>regresar torneo</a>
                        <a class="btn btn-info" href={{"/SCDW/public/partido/detalle/".$campeonato->codcampeonato."/".$torneo->idtorneo}}>actulizar partidos</a>
                        <?php
                        $fechasProg=Fechas::all();
                        $fechas=Fechas::paginate(1);

                        ?>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div>

    	<div class="row col-no-gutter-container">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">actualizar Fechas</div>
					<div class="panel-body">
						<div class="col-md-6">
							  {{ Form::open(array('url' => 'fecha/edit/'.$idcampeonato.'/'.$idtorneo.'/add','method' => 'post', 'files' => true, 'class' => 'form-inline')) }}

                            <div class="form-group">
                                {{Form::label('nro de fecha')}}
                                {{Form::select('nrofecha', $arr1,' ',array('class' => 'form-control'))}}
                                <span class="help-block">{{ $errors->first('nrofecha') }}</span>
                            </div>
                            <div class="form-group">
                                {{ Form::label('fecha')}}
                                {{Form::date('fecha','',array('class' => 'form-control'))}}
                                <span class="help-block">{{ $errors->first('fecha') }}</span>
                            </div>
                            <div class="form-group">
                                {{ Form::label('hora inicio')}}
                                {{Form::time('horainicio','',array('class' => 'form-control'))}}
                                <span class="help-block">{{ $errors->first('horainicio') }}</span>
                            </div>
                            <div class="form-group">
                                {{ Form::label('lugar')}}
                                {{Form::text('lugar','',array('class' => 'form-control'))}}
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
			</div><!-- /.col-->
        </div>

        <div class="row col-no-gutter-container" id="equipos">
            <div class="col-lg-12 col-no-gutter">
                <div class="panel panel-success">
                    <div class="panel-heading"> fechas programadas</div>
                    <div class="panel-body color-orange">
                        <div class="panel panel-footer" id="fecha">

                            <?php
                            $fechasProg=Fechas::all();
                            $fechas=Fechas::paginate(1);

                            ?>


                        </div>
                        <?php foreach($fechas as $value ){?>
                        <div class="panel panel-footer" id="fecha">

                            <strong><span class="text-primary"><h2 class="color-blue "> {{$value->diafecha}}</h2></span></strong><br>
                        </div>
                        <?php $partidos= Fixture::where('idfecha','=',$value->nrofecha)->get()?>
                            <div class="row ">

                                <?php foreach($partidos as $value2 ){?>
                                <div class="panel-default ">
                                    <div class="panel-heading"> partido {{$value2->nropartido}}</div>
                                    <div class="panel-body">
                                        <div class="container-fluid" >

                                            <div class="panel-info" >

                                                {{substr($value2->hora,0,5)."hrs"}}
                                             </div>

                                              <?php
                                                //recuperar equipos
                                                $equipo1=Equipo::find($value2->equipo1);
                                                $equipo2=Equipo::find($value2->equipo2);

                                            ?>
                                                <div class="col-lg-4">
                                                 {{ HTML::image('storage/equipo/'.$equipo1->logo,'User Image',array('class'=>'img-responsive','style'=>'width: 50px')) }} </div>
                                            <div class="col-lg-4">

                                            {{ HTML::image('storage/equipo/'."vs.jpg",'User Image',array('class'=>'img-responsive','style'=>'width: 50px')) }}</div>
                                                <div class="col-lg-4">
                                                {{ HTML::image('storage/equipo/'.$equipo2->logo,'User Image',array('class'=>'img-responsive','style'=>'width: 50px')) }}</div>



                                        </div>
                                    </div>
                               </div>
                                <?php }?>
                                    </tbody>
                              </table >
                            </div>
                        <?php }?>

                        {{ $fechas->fragment('fecha')->links() }}



                    </div>

                </div>
            </div>
        </div>

	<!--/.main-->


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