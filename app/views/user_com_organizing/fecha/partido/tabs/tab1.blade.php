<?php

    $arr=array();
    foreach($arbitros as $value)
    {
        if(!ArbitroPorPartido::where('codPartido','=',$partido->codPartido)->where('dni','=',$value->dni)->first())
        $arr[$value->dni]=$value->dni." ".$value->nombre." ".$value->ApellidoP." ".$value->ApellidoM;
    }
    $arr1=array();
    if(!ArbitroPorPartido::where('codPartido','=',$partido->codPartido)->where('rol','=','principal')->first())
        $arr1['principal']='principal';
    if(!ArbitroPorPartido::where('codPartido','=',$partido->codPartido)->where('rol','=','asistente1')->first())
        $arr1['asistente1']='asistente1';
    if(!ArbitroPorPartido::where('codPartido','=',$partido->codPartido)->where('rol','=','asistente2')->first())
        $arr1['asistente2']='asistente2';

?>

@if($arbixPart<3)
    <div class="col-md-12 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading">Ingrese los Arbitros del partido</div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <div class="col-md-12">
                        {{ Form::open(array('url'=>'fechas/detail/partido/arbitros/add.html','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                        <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                        {{ Form::hidden('idtorneo',$torneo->codRueda) }}
                        {{ Form::hidden('codcampeonato',$codcampeonato) }}
                        {{ Form::hidden('idfecha',$idfecha )}}
                        {{ Form::hidden('codpartido',$partido->codPartido) }}

                        <label>Agregar arbitro:</label>
                        <div class="form-group">
                            {{Form::select('arbitro', $arr,'',array('class' => 'form-control'))}}
                            <span class="help-block">{{ $errors->first('agenda') }}</span>
                        </div>
                        <label>Rol:</label>
                        <div class="form-group">
                            {{Form::select('rol', $arr1,'',array('class' => 'form-control'))}}
                            <span class="help-block">{{ $errors->first('agenda') }}</span>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        {{ Form::close()}}
                        <!-- END CONTENIDO DEL FORMULARIO -->
                    </div>
                </div>
            </div>
        </div>
    </div>



@endif
<div class="col-md-12 col-no-gutter">
    <div class="panel panel-default">
        <div class="panel-heading">Arbitros del partido</div>
        <div class="panel-body">
            <div class="canvas-wrapper">
                <div class="col-md-12">
                    @foreach($todosArbitros as $value)
                    <strong class="primary-font">Arbitro {{$value->rol}}:<br> </strong>
                    <strong class="primary-font">Nombre y Apellidos:</strong>
                    <span class="text-primary">
                               {{Arbitro::find($value->dni)->nombre}} {{Arbitro::find($value->dni)->ApellidoP}} {{Arbitro::find($value->dni)->ApellidoM}}
                            </span><br>
                    <strong class="primary-font">DNI:  </strong>
                    <span class="text-primary">
                                {{$value->dni}}
                            </span><br>
                    <strong class="primary-font">Observaciones: </strong>
                    <span class="text-primary">
                            {{$value->observaciones}}
                        </span><br><br><br>
                    @endforeach
                    <br>
                </div>
            </div>
        </div>
        <div class="panel-footer">

        </div>
    </div>
</div>
