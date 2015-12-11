@extends('_templates.apptemp')

@section('titulo')
    @lang('Torneo')
@stop

@section('estilos')
@stop

@section('rutanavegacion')
@stop

@section('nombrevista')
    @lang('Torneos')
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
                            <select  class="form-control" name="tipo">
                                <option class="form-control" value="apertura">Apertura</option>
                                <option class="form-control" value="clausura">Clausura</option>
                                <option class="form-control" value="play off">Play off</option>
                            </select>
                        </div>
                        <div class="form-group">
                            {{Form::label('lbltipo','Dia Inicio')}}
                            {{Form::text('diainicio',null,['class'=>'form-control','placeholder'=>'2015-12-21','id'=>'docenteauto'])}}
                        </div>
                        <div class="form-group">
                            {{Form::hidden('nrofechas',0,['class'=>'form-control','placeholder'=>'5','id'=>'docenteauto'])}}
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

