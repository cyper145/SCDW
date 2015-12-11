@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.partido')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/programacion/listar');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('contenido')

< <?php
      $i=0;
      $codi="";
    ?>

     <table border="4" CELLSPACING="5" WIDTH="800">
    <table class="table table-bordered">
     <div class="panel-heading">Lista de Partidos</div>
      <thead>
        <th>Codigo de Programacion</th>
        <th>Dia del partido</th>
        <th>Nro de partido</th>
        <th>Tipo_partido</th>
        <th>Fecha</th>
        <th>Codigo de escenario</th>
      </thead>
      <tbody>
       @foreach($todoprogramacion as $programacion)
       <?php $i++;  ?>
        <tr>       
         <td>{{$programacion->codprogramacion}}</td>
         <td>{{$programacion->diadepartido}}</td>
         <td>{{$programacion->nrodepartido}}</td>
         <td>{{$programacion->nrofecha}}</td>
         <td>{{$programacion->codescenario}}</td>
        </tr>
       @endforeach
      </tbody>
     </table>
@stop

