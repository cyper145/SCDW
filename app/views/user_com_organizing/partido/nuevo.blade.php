@extends('_templates.apptemp')



@section('rutanavegacion')        
       
	   
@stop

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Crear Partido</div>
                <div class="panel-body">
                    <div class="col-md-6">
                      {{ Form::open(array('url' => 'partido/formulario1','method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
                        <div class="form-group">
                         <label>Codigo del Partido</label>
                        <input class="form-control" placeholder="P000" name="Cod_partido">
                        </div>
                        <div class="form-group">
                        <label>Hora de Inicio </label>
                        <input class="form-control" placeholder="2015-12-02 9:40:00" name="Hora_inicio">
                        </div>
                        <div class="form-group">
                        <label>Hora Final</label>
                        <input class="form-control" placeholder="2015-12-02 10:40:00" name="Hora_final">
                        </div>
                        <div class="form-group">
                        <label>Tipo de Partido</label>
                        <input class="form-control" placeholder="tipo de partido" name="Tipo_partido">
                        </div>
                    <div class="form-group">
                        <label>Observacion</label>
                        <input class="form-control" placeholder="observacion" name="Observacion">
                           </div>
                                    
                            <div class="form-group">
                             <label>Cod de Programacion</label>
                              <input class="form-control" placeholder="cod de programacion" name="Cod_programacion">
                            </div>
                            <div class="form-group">
                                <label>Id del Arbitro</label>
                                <input class="form-control" placeholder="Id del arbitro" name="Idarbitro">
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

