@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
	<li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
	<li>Nuevo Campeonato</li>
@stop

@section('nombrevista')
    @lang('Nuevo campeonato')
@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allerrors')
    @include('alerts.errors')
    <?php
    $users = DB::table('tcom_org')->count();
    $users++;
    $cadena= "CAM0"."0".$users;


    ?>
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Crear Campeonato</div>
            <div class="panel-body">
                <div class="col-md-6">
                    {{ Form::open(array('url'=>'campeonato/formulario1','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                    <div class="form-group">
                        <label>Codigo </label>
                        <input class="form-control" value="{{$cadena}}" placeholder="Codigo del campeonato" name="Codigo" readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" placeholder="Nombre" name="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Año Academico</label>
                        <input class="form-control" placeholder="2015-II" name="Anio" required>
                    </div>
                    <div class="form-group">
                        {{ Form::label('Fecha creacion')}}
                        {{ Form::date('Fecha','',array('class' => 'form-control','placeholder'=>'05/05/2015' )) }}
                        <span class="help-block">{{ $errors->first('fecha') }}</span>
                    </div>

                    <!-- estudiar archivos-->
                    <div class="form-group">
                        <label>logo:</label><br>
                        <div class="col-sm-10">
                            <input name="reglamento" type="file" id="imgInp" class="btn btn-default">
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

