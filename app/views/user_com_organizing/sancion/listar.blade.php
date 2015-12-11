    @extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a></li>
       
@stop

@section('nombrevista')
    <!--@lang('Home')-->
@stop

@section('contenido')
     <?php  if(isset($_GET["buscar"])) { $cont=0;  ?>
                  <!--  <table class="table table-bordered">
                        <tr>
                            <th style="width: 30px">Código</th>
                            <th >Nombres</th>
                            <th >Correo</th>
                            <th >DNI</th>

                        </tr>
                         -- LISTAR DocenteS 
                        @foreach($Busqueda as $doc)
                        <tr>
                            <td>{{$doc->iddocente}}</td>
                            <td>{{$doc->nombres}} {{$doc->apellidos}}</td>
                            <td>{{$doc->correo}}</td>
                            <td>{{$doc->dni}}</td>
                            <td>
                                <a href="/sis_academico/public/docente/{{ $doc->iddocente }}/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                 <a class="btn btn-xs btn-primary;background-color:yellow" href="{{ URL::to( '/docente/filtroAsistencia');}}/{{$doc->iddocente}}">Ver asistencia</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>-->








                    <?php }else{ $cont=0;?>

<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Sanciones <div style="float:right"><a href="insertar">Agregar</a></div></div> 
                    

     
                    <div class="panel-body">
                        <table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table table-bordered">
                            <thead>
                            {{ Form::open(array('url' => 'sancion/buscarsancion',
                                'method' => 'GET',
                                'class' =>'form-inline',
                                'role' => 'form')) }}
                            <tr>
                                <th data-field="state" data-checkbox="true" >{{Form::input('text','Sancion',Input::get('Sancion'),array('class'=>'form-control')) }}</th>
                                <th data-field="id" data-sortable="true">{{Form::input('text','Tipo sancion',Input::get('Tipo sancion'),array('class'=>'form-control')) }}</th>
                                <th data-field="name"  data-sortable="true">{{Form::input('text','Nro conclusion',Input::get('Nro conclusion'),array('class'=>'form-control')) }}</th>
                                <th data-field="price" data-sortable="true">{{Form::input('text','Jugador en juego',Input::get('Jugador en juego'),array('class'=>'form-control')) }}</th>
                                <th data-field="id" data-sortable="true">{{Form::input('text','Equipo en partido',Input::get('Equipo en partido'),array('class'=>'form-control')) }}</th>
                                <th data-field="price" data-sortable="true">{{Form::input('submit',null,'Buscar',array('class'=> 'btn btn-primary'))}}</th>
                            </tr>
                            {{Form::close()}} 
                            <tr>
                                <th data-field="state" data-checkbox="true" style="text-decoration:underline" >Sancion</th>
                                <th data-field="id" data-sortable="true" style="text-decoration:underline">Tipo sancion</th>
                                <th data-field="name"  data-sortable="true" style="text-decoration:underline">Nro Conclusion</th>
                                <th data-field="price" data-sortable="true" style="text-decoration:underline">Jugador en juego</th>
                                <th data-field="price" data-sortable="true" style="text-decoration:underline">Equipo en partido</th>
                            </tr>
                            </thead>
                            <tbody>
                                <!--<tr><td>camp001</td><td>abc</td><td>1234</td><td>5678</td></tr>-->
                                @foreach($todosancion as $sancion)
                        <tr>
                            <td>{{$sancion->idsancion}}</td>
                            <td>{{$sancion->tiposancion}}</td>
                            <td>{{$sancion->nroconclusion}}</td>
                            <td>{{$sancion->idjuegadorenjuego}}</td>
                            <td>{{$sancion->idequipoenpartido}}</td>
                            <td>
                                <a href="editar/{{ $sancion->idsancion}}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                                 <a href="eliminar/{{ $sancion->idsancion}}" class="btn btn-xs btn-secundary" style="background-color:#900 !important"><i class="glyphicon glyphicon-trash" ></i></a>
                                 <!--<a class="btn btn-xs btn-primary;background-color:yellow" href="{{ URL::to( '/docente/filtroAsistencia');}}/{{$camp->codcampeonato}}">Ver asistencia</a>-->
                            </td>
                        </tr>
                        @endforeach
                            </tbody>
                        </table>
                         <div class="box-footer clearfix text-center">
                    <ul class="pagination pagination-sm no-margin">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div><!--/.row-->  



                    <!--<table class="table table-bordered">
                        <tr>
                            <th style="width: 30px">Código</th>
                            <th >Nombres</th>
                            <th >Correo</th>
                            <th >DNI</th>

                        </tr>
                         LISTAR DocenteS
                        @foreach($todocampeonato as $camp)
                        <tr>
                            <td>{{$camp->codcampeonato}}</td>
                            <td>{{$camp->nombre}} {{$camp->anioacademico}}</td>
                            <td>{{$camp->fechacreacion}}</td>
                            <td>{{$camp->reglamento}}</td>
                            <td>
                                <a href="/sis_academico/public/docente/{{ $camp->codcampeonato}}/edit" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                 <a class="btn btn-xs btn-primary;background-color:yellow" href="{{ URL::to( '/docente/filtroAsistencia');}}/{{$camp->codcampeonato}}">Ver asistencia</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>-->
            
    
    <!--    <div class="container-fluid">
            
    
                
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Form Elements</div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <form role="form">
                            
                                <div class="form-group">
                                    <label>Text Input</label>
                                    <input class="form-control" placeholder="Placeholder">
                                </div>
                                                                
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
                                <button type="reset" class="btn btn-default">Reset Button</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>--><!-- /.col-->
    <!--    </div> /.row -->
        
    <!--</div>/.main-->

    <!---->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>    
     <script type="text/javascript">
            function validar(e) {
                tecla = (document.all) ? e.keyCode : e.which;
                if (tecla==8) return true;
                if (tecla==44) return true;
                if (tecla==48) return true;
                if (tecla==49) return true;
                if (tecla==50) return true;
                if (tecla==51) return true;
                if (tecla==52) return true;
                if (tecla==53) return true;
                if (tecla==54) return true;
                if (tecla==55) return true;
                if (tecla==56) return true;
                if (tecla==57) return true;
                patron = /1/; //ver nota
                te = String.fromCharCode(tecla);
                return patron.test(te);
            }
        </script>
@stop

