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
                  
                    <?php }else{ $cont=0;?>

<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Lista de docentes <div style="float:right"></div></div> 
          

     
          <div class="panel-body">
          <?php
            $i=0;
            $codi="";
          ?>
            <table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table table-bordered">
                <thead>
                {{ Form::open(array('url' => 'docentes/buscardocentes',
                                'method' => 'GET',
                                'class' =>'form-inline',
                                'role' => 'form')) }}
                <tr><th data-field="price" data-sortable="true"></th>
                    <th data-field="state" data-checkbox="true" >{{Form::input('text','Codigo',Input::get('Codigo'),array('class'=>'form-control')) }}</th>
                    <th data-field="id" data-sortable="true">{{Form::input('text','Nombre',Input::get('Nombre'),array('class'=>'form-control')) }}</th>
                    <th data-field="name"  data-sortable="true">{{Form::input('text','Categoria',Input::get('Categoria'),array('class'=>'form-control')) }}</th>
                    <th data-field="price" data-sortable="true">{{Form::input('text','iddepartamento',Input::get('iddepartamento'),array('class'=>'form-control')) }}</th>
                    <th data-field="price" data-sortable="true">{{Form::input('submit',null,'Buscar',array('class'=> 'btn btn-primary'))}}</th>
                    
                </tr>
                {{Form::close()}} 
                <tr>
                  <th data-field="state" data-checkbox="true" style="text-decoration:underline" >No.</th>
                    <th data-field="state" data-checkbox="true" style="text-decoration:underline" >Codigo</th>
                    <th data-field="id" data-sortable="true" style="text-decoration:underline">Nombre</th>
                    <th data-field="name"  data-sortable="true" style="text-decoration:underline">Categoria</th>
                    <th data-field="price" data-sortable="true" style="text-decoration:underline">ID Departamento</th>
                    <th data-field="price" data-sortable="true" style="text-decoration:underline">Asignar</th>
                </tr>
                </thead>
                <tbody>
                <?php $docentes = Docente::all();?>
                  @foreach($docentes as $docente)
                  <?php $i++;  ?>
                        <tr>
                            <td>{{$i}}</td>
                           <td>{{$docente->coddocente}}</td>
                           <td>{{$docente->nombre.' '.$docente->apellidopaterno.' '.$docente->apellidomaterno}}</td>
                           <td>{{$docente->categoria}}</td>
                           <td>{{$docente->iddepartamento}}</td>
                            <td>
                                <a href="insertar/{{ $docente->coddocente}}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
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
    </div>
    <!--/.row-->  

    
    
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

