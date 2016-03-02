@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li>Nueva configuracion</li>
@stop

@section('nombrevista')
    @lang('Nueva Configuracion')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allerrors')
    @include('alerts.errors')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Nueva configuracion  del campeonato</div>
            <div class="panel-body">
                <div class="col-md-12">
                    {{ Form::open(array('method' => 'POST','url'=>'campeonato/detail/'.$campeonato->codcampeonato.'/configuracionD/add.html','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}

                    <div class="row">
                        <!-- participantes-->
                        <div class="col-md-6">
                            <div class="panel-default">
                                <div class="panel-heading">
                                    <h3>configuracion:</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        {{ Form::label('descripcion')}}
                                        {{ Form::text('descripcion','',array('class' => 'form-control')) }}

                                        <span class="help-block">{{ $errors->first('descripcion') }}</span>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('valor')}}
                                        {{ Form::text('valor','',array('class' => 'form-control')) }}
                                        <span class="help-block">{{ $errors->first('valor') }}</span>
                                    </div>

                                </div>

                            </div>

                            <!-- endparticipantes-->
                        </div>

                    </div>

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
