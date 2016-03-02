@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li>Nueva actividad</li>
@stop

@section('nombrevista')
    @lang('Nueva Actividad')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allerrors')
    @include('alerts.errors')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Nuevo cronograma de actividades</div>
            <div class="panel-body">
                <div class="col-md-12">
                    {{ Form::open(array('method' => 'POST','url'=>'campeonato/detail/'.$campeonato->codCampeonato.'/actividad/add.html','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                    <!-- torneo-->
                    <div class="col-lg-offset-1">
                        <div class="panel-default">
                            <div class="panel-heading">
                                <h3> actividad:</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label> actividad</label>
                                    <input class="form-control" placeholder="actividad a realizar" name="actividad" required>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('fecha inicio')}}
                                    {{ Form::date('fechaI',date("Y-M-D"),array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('fecha final')}}
                                    {{ Form::date('fechaf','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>
                                <div class="form-group">
                                    <label> observaciones</label>
                                    <input class="form-control" placeholder="observaciones" name="observacion" >
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- end torne0-->




                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="reset" class="btn btn-default">Limpiar</button>
                    <button type="submit" class="btn btn-danger" onclick="history.back()">Cancelar</button>
                    {{ Form::close() }}
                    <div class="pull-right">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
