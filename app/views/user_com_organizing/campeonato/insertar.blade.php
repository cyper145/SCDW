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
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Crear Campeonato</div>
            <div class="panel-body">
                <div class="col-md-6">
                    {{ Form::open(array('url'=>'campeonato/formulario1','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                    <div class="form-group">
                        <label>Codigo (codigo tiene que ser autogenerado de tipo int)</label>
                        <input class="form-control" placeholder="Codigo del campeonato" name="Codigo" required>
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
                        <label>Fecha creacion</label>
                        <input class="form-control" placeholder="05/05/2015" name="Fecha" required>
                    </div>
                    <div class="form-group">
                        <label>Reglamento(Bases) en esta parte se tiene que inportar un archivo .doc o .pdf</label>
                        <textarea class="form-control" rows="3" name="reglamento" ></textarea>
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

