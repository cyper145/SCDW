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
            <div class="panel-heading">Nueva configuracion Inicial del campeonato</div>
            <div class="panel-body">
                <div class="col-md-12">
                    {{ Form::open(array('method' => 'POST','url'=>'campeonato/detail/'.$campeonato->codcampeonato.'/configuracion/add.html','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}

                    <div class="row">
                        <div class="col-md-6">
                    <!-- torneo-->
                        <div class="panel-default">
                            <div class="panel-heading">
                                <h3> campeonato:</h3>
                            </div>
                            <div class="panel-body">
                                <label> tipo todos contrados<br></label>
                                <div class="form-group">
                                <label> nro ruedas</label>
                                <input class="form-control" placeholder="nro ruedas" name="ruedas" required>
                                </div>
                                <label> fechas para inscripcion <br></label>
                                <div class="form-group">
                                    {{ Form::label('fecha inicio')}}
                                    {{ Form::date('fechaI','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('fecha final')}}
                                    {{ Form::date('fechaf','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>
                            </div>

                        </div>
                    <!-- end torne0-->
                        </div>
                        <div class="col-md-6">
                    <!--  ruedas-->
                        <div class="panel-default">
                            <div class="panel-heading">
                                <h3>torneo :</h3>
                            </div>
                            <div class="panel-body">
                                <label> tentativas de fechas de inicio <br></label>
                                <div class="form-group">
                                    {{ Form::label('apertura')}}
                                    {{ Form::date('apertura','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('clausura')}}
                                    {{ Form::date('clausura','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>
                            </div>

                        </div>
                    <!--  endruedas-->
                            </div>
                    </div>
                    <div class="row">
                    <!-- participantes-->
                        <div class="col-md-6">
                        <div class="panel-default">
                            <div class="panel-heading">
                                <h3>participantes :</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    {{ Form::label('maximo nro de equipos')}}
                                    {{ Form::text('maximo','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('maximo de jugadores libres')}}
                                    {{ Form::text('maximoL','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>

                            </div>

                        </div>

                    <!-- endparticipantes-->
                        </div>
                        <div class="col-md-6">
                    <!--partido -->
                        <div class="panel-default">
                            <div class="panel-heading">
                                <h3>partido :</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    {{ Form::label('duracion de tiempos')}}
                                    {{ Form::text('duracion','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('tiempo de descanso')}}
                                    {{ Form::text('descanso','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('maximo de jugadores menores de 35 años')}}
                                    {{ Form::text('maximoM','',array('class' => 'form-control')) }}

                                    <span class="help-block">{{ $errors->first('fecha') }}</span>
                                </div>

                            </div>

                        </div>
                    <!--endpartido -->
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
