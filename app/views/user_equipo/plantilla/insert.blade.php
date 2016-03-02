@extends('_templates.apptemp')

@section('titulo')
    @lang('acta')
@stop

@section('rutanavegacion')

@stop

@section('nombrevista')
    @lang('Acta de reunion ')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop



@section('contenido')
<?php
$nroPar=DB::table('tpartido')->count();
$Pla=DB::table('tplantilla')->where('codPantilla','=',$codplantilla)->first();
$nroPla=$Pla->nroPlantilla;
foreach($todosJugadores as $value)
    {
        $cod=$value->dni.$nroPla.$nroPar;
        if(!Planilla::find($cod))
        $arr[$value->dni]=Docente::find($value->codDocente)->nombre." ".
                          Docente::find($value->codDocente)->apellidoP." ".
                          Docente::find($value->codDocente)->apellidoM;


    }



?>


<!-- cabecera-->
<div class="row col-lg-12">
    <div class="col-lg-12 col-no-gutter">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de acta: </div>
            <div class="panel-body">
                <strong class="primary-font">fecha de reunion: </strong><span class="text-primary"></span><br>
                <strong class="primary-font">reunion de la  </strong><span class="text-primary"></span><br>

            </div>
            <div class="panel panel-footer">

                <a class="btn btn-info" href="#asistente">Asistencia</a>
                <a class="btn btn-info" href="#agenda">temas de agenda</a>
                <a class="btn btn-info" href="#conclusion">conclusiones de agendas</a>
            </div>
        </div>
    </div>
</div>
<br>
<!-- endcabecera -->
<div class="row row-no-gutter col-no-gutter-container" id="agenda">
    <div class="col-md-12 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading">temas tratados
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="canvas-wrapper">
                        {{Form::open(array('method' => 'POST', 'url' => 'plantilla/insertar.html','class'=>'form_horizontal', 'role' => 'form'))}}

                            {{Form::hidden('codequipo',$codequipo)}}
                            {{Form::hidden('codplantilla',$codplantilla)}}

                            <div class="form-group ">
                            {{ Form::label('condicion', 'juagadores en equipo',array("class"=>"control-label")) }}
                            {{Form::select('dni', $arr,$arr["09090900"],array('class' => 'form-control'))}}
                            <span class="help-block">{{ $errors->first('dni') }}</span>
                            </div>
                            <div class="form-group">
                             {{Form::label('lblcamiseta','camiseta:')}}
                             {{Form::number('camiseta','',['class'=>'form-control','placeholder'=>'ingrese el nro camiseta'])}}
                            </div>

                            <div class="form-group">
                                {{ Form::label('condicion', 'Condicion',array("class"=>"control-label")) }}
                                <select  class="form-control" name="condicion">
                                    <option class="form-control" value="delantero">Delantero</option>
                                    <option class="form-control" value="mediocampista">Mediocampista</option>
                                    <option class="form-control" value="guardameta">Guardameta</option>
                                    <option class="form-control" value="defensa">Defensa</option>
                                    <option class="form-control" value="suplente">Suplente</option>
                                </select>
                            </div>
                            <div class="form-group">
                                {{ Form::label('escampitan', 'Es campitan?',array("class"=>"control-label")) }}
                                <select  class="form-control" name="escapitan">
                                    <option class="form-control" value="no">No</option>
                                    <option class="form-control" value="si">Si</option>
                                </select>
                            </div>

                        <div class="form-group">
                            <p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
                        </div>
                        {{Form::close()}}
                        </div>
                    </div>
                    <!--
                    <div class="col-md-6">
                        <table data-toggle="table" data-url="tables/data2.json">
                            <thead>
                            <tr>
                                <th>nroAgenda</th>
                                <th>codAgenda</th>
                                <th>tema</th>
                                <th>acciones</th>

                            </tr>
                            </thead>
                            <tbody>

                            foreach($todoAgenda as $cat)
                                <tr>
                                    <td>{$i++}}</td>
                                    <td>{$cat->codAgenda}}</td>
                                    <td>{$cat->tema}}</td>
                                    <td>

                                        <a href="{$buscar}}/delete2/{$cat->codAgenda}}" class="btn btn-default">
                                            <span class="glyphicon glyphicon-remove"></span> Eliminar
                                        </a>
                                    </td>


                                </tr>
                            endforeach
                            </tbody>
                        </table>
                    </div>
                    -->
                </div>

            </div>
            <div class="panel-footer">
                <a class="btn btn-success" href="#">Aceptar</a>
            </div>
        </div>
    </div>
</div>
<br>
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>

@stop
@endsection
