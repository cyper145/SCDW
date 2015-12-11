@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.partido')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/partido/listar');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('contenido')

< <?php
      $i=0;
      $codi="";
    ?>

     <table border="4" CELLSPACING="5" WIDTH="800">
    
     <div class="panel-heading">Lista de Partidos</div>
      <thead>
        <th>Cod_partido</th>
        <th>Hora_inicio</th>
        <th>Hora_final</th>
        <th>Tipo_partido</th>
        <th>Observacion</th>
        <th>Cod_programacion</th>
        <th>Idarbitro</th>
       
      </thead>
      <tbody>
       @foreach($todopartidos as $partido)
       <?php $i++;  ?>
        <tr>

        
         <td>{{$partido->codpartido}}</td>
         <td>{{$partido->horainicio}}</td>
         <td>{{$partido->horafin}}</td>
         <td>{{$partido->tipopartido}}</td>
         <td>{{$partido->observacion}}</td>
         <td>{{$partido->codprogramacion}}</td>
         <td>{{$partido->idarbitroporpartido}}</td>
        </tr>
       @endforeach
      </tbody>
     </table>
@stop

