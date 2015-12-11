@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop


@section('rutanavegacion')
    <li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a></li>
       
@stop

@section('nombrevista')
    @lang('INCIDENCIAS')
@stop

@section('contenido')
        
        
        
        
        
    <!--</div>/.main-->

    <!--
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Forms</h1>
            </div>
        </div>/.row-->
                
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Incidencias</div>
                    <div class="panel-body">
                        <div class="col-md-6">
                              {{ Form::open(array('url' => 'incidencias/formulario1','method' => 'post', 'files' => true, 'class' => 'form-horizontal')) }}
                            
                                <div class="form-group">
                                    <label>Codigo de la incidencia</label>
                                    <input class="form-control" placeholder="Codigo incidencia" name="Codigo incidencia">
                                </div>
                                <div class="form-group">
                                    <label>Incidencia</label>
                                    <input class="form-control" rows="3" name="Incidencia">
                                </div>
                                <div class="form-group">
                                    <label>Hora</label>
                                    <input class="form-control" placeholder="00:00" name="Hora">
                                </div>

                                <div class="form-group">
                                
                                
                                    <label>Codigo de partido</label>
                                    <input class="form-control" placeholder="05/05/2015" name="Fecha">
                                </div>

                                    
                                <div class="form-group">
                                    <label>Reglamento</label>
                                    <textarea class="form-control" rows="3" name="reglamento"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="reset" class="btn btn-default">Limpiar</button>
                            {{ Form::close() }}
<!--
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                
                                <div class="form-group checkbox">
                                  <label>
                                    <input type="checkbox">Remember me</label>
                                </div>
                                                                
                                <div class="form-group">
                                    <label>File input</label>
                                    <input type="file">
                                     <p class="help-block">Example block-level help text here.</p>
                                </div>
                                
                                <div class="form-group">
                                    <label>Text area</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                                
                                <label>Validation</label>
                                <div class="form-group has-success">
                                    <input class="form-control" placeholder="Success">
                                </div>
                                <div class="form-group has-warning">
                                    <input class="form-control" placeholder="Warning">
                                </div>
                                <div class="form-group has-error">
                                    <input class="form-control" placeholder="Error">
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                            
                                <div class="form-group">
                                    <label>Checkboxes</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 1
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 2
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 3
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="">Checkbox 4
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Radio Buttons</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>Radio Button 1
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Radio Button 2
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Radio Button 3
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">Radio Button 4
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Selects</label>
                                    <select class="form-control">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Multiple Selects</label>
                                    <select multiple class="form-control">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit Button</button>
                                <button type="reset" class="btn btn-default">Reset Button</button>-->
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
        
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

