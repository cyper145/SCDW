@extends('_templates.apptemp')

@section('titulo')
    @lang('Torneo')
@stop

@section('estilos')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li><a href="{{ URL::to('/torneo/'.$codcampeonato);}}">Torneos</a></li>
    <li>Nuevo Torneo</li>
@stop

@section('nombrevista')
    @lang('Torneos')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Crear un Torneo</div>
                <div class="panel-body">
                    <!-- BEGIN PARA MANEJO DE ERRORES -->
                    @include('alerts.allerrors')
                    @include('alerts.errors')
                    <!-- END PARA MANEJO DE ERRORES -->
                    <div class="col-md-12">
                        {{ Form::open(array('route'=>'torneo.store','method'=>'POST','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                        <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                        {{Form::hidden('codcampeonato',$codcampeonato)}}
                        <div class="form-group">
                            <label>Tipo de Torneo</label>
                            <select  class="form-control" name="tipo" required>
                                <option class="form-control" value="apertura">Apertura</option>
                                <option class="form-control" value="clausura">Clausura</option>
                                <option class="form-control" value="play off">Play off</option>
                            </select>
                        </div>
                        <div class="form-group">
                            {{Form::label('lbltipo','Dia Inicio')}}
                            {{ Form::text('diainicio', null, array('type' => 'text','required', 'class' => 'form-control datepicker','placeholder' => '2015-12-21', 'id' => 'calendar')) }}
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-default">Limpiar</button>
                        <button type="submit" class="btn btn-danger" onclick="history.back()">Cancelar</button>
                        {{ Form::close()}}
                        <!-- END CONTENIDO DEL FORMULARIO -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@section ('scrips')
@stop

@endsection

