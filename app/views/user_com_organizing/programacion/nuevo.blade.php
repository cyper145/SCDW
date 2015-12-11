@extends('_templates.apptemp')



@section('rutanavegacion')        
       
	   
@stop

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Nueva Programacion</div>
                <div class="panel-body">
                    <div class="col-md-6">
                      {{ Form::open(array('url' => 'programacion/formulario1','method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
                        <div class="form-group">
                         <label>Codigo de Programacion</label>
                        <input class="form-control" placeholder=" " name="Cod_programacion">
                        </div>
                        <div class="form-group">
                        <label>Dia del Partido </label>
                        <input class="form-control" placeholder="sabado" name="Dia_partido">
                        </div>
                        <div class="form-group">
                        <label>Nro de Partido</label>
                        <input class="form-control" placeholder="1" name="Nro_partido">
                        </div>
                        <div class="form-group">
                        <label>Tipo de Partido</label>
                        <input class="form-control" placeholder="tipo de partido" name="Tipo_partido">
                        </div>
                        <div class="form-group">
                        <label>Nro de fecha</label>
                        <input class="form-control" placeholder="nro de fecha" name="Nro de fecha">
                        </div>
                        <div class="form-group">
                         <label>Cod de escenario</label>
                          <input class="form-control" placeholder="codigo de escenario" name="Cod_programacion">
                        </div>
                             <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="reset" class="btn btn-default">Limpiar</button>
                            {{ Form::close() }}     
    </div><!--/.main-->
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

