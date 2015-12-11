@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop


@section('rutanavegacion')
    <li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a></li>
       
@stop

@section('nombrevista')
    @lang('SANCIONES')
@stop

@section('contenido')

<div class="row">
            <div class="col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Sancion</div>
                    <div class="panel-body">
                        <div class="col-md-10">
                              {{ Form::open(array('url' => 'sancion/formulario1','method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
                                
                                <div class="form-group">
                                    <label>Codigo de Sancion</label>
                                    <input class="form-control" placeholder="Codigo de la sancion" name="Codigo de la sancion">
                                </div>
                                <div class="form-group">
                                    <label>Tipo de Sancion</label>
                                    <input class="form-control" placeholder="Tipo de sancion" name="Tipo de sancion">
                                </div>
                                <div class="form-group">
                                    <label>Conclusiones</label>
                                    <input class="form-control" placeholder="Conclusiones" name="Conclusiones">
                                </div>
                                <div class="form-group">
                                    <label>Jugador en Juego</label>
                                    <input class="form-control" placeholder="Jugador" name="Jugador">
                                </div>
                                <div class="form-group">
                                    <label>Equipo en partido</label>
                                    <input class="form-control" placeholder="Equipo en partido" name="Equipo en partido">
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

