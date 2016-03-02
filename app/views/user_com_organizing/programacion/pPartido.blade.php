@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')

    <li>Detalle del programacion</li>
@stop

@section('nombrevista')
    @lang('Detalles del Torneo')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')

<?php
    $users = DB::table('tescenario')->get();
      $arr=  array();
    foreach($users as $value)
       {
           $arr[$value->codEscenario]=$value->nombre." ".$value->lugar;

       }
?>
<!-- cabecera-->
<div class="row col-lg-12">
    <div class="col-lg-12 col-no-gutter">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Programacion de partido: </div>
            <div class="panel-body">
                <strong class="primary-font">partido: </strong><span class="text-primary">{{Equipo::find(Fixture::find($codfixture)->codEquipo1)->nombre. " vs " .Equipo::find(Fixture::find($codfixture)->codEquipo2)->nombre }}</span><br>
            </div>

        </div>
    </div>
</div>
<br>
<!-- endcabecera -->

<!-- asistencia-->
<div class="row row-no-gutter col-no-gutter-container" >
    <div class="col-md-12 col-no-gutter ">
        <div class="panel panel-default">
            <div class="panel-heading">programacion de partido
            </div>
            <!-- BEGIN PARA MANEJO DE ERRORES -->
            @include('alerts.allerrors')
            @include('alerts.errors')
            <!-- END PARA MANEJO DE ERRORES -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">

                        {{Form::open(array('method' => 'POST', 'url' => 'fecha/edit/'.$codcampeonato.'/'.$codtorneo.'/programacioPartido/'.$codfixture,'autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                        <div class="form-group" >
                            {{Form::label('lblescenario','Escenario')}}
                            {{Form::select('escenario',$arr,$arr["ESC0001"],['class'=>'form-control','placeholder'=>'ingrese escenario','id'=>'autoescenario'])}}
                        </div>

                        <div class="form-group">
                            <p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
                        </div>

                        {{Form::close()}}

                    </div>


                </div>
            </div>
            <div class="panel-footer">
                <a class="btn btn-success" href="#">Aceptar</a>
            </div>
        </div>
    </div>
</div>
<br>
<!-- endasistencia-->
@section ('scrips')

    <script src="{{asset('/js/jquery-ui/jquery-ui.js')}}"></script>

    <script>
        $(function() {
            $("#autoescenario").autocomplete({
                source:'escenarioauto',
                minLength: 1,
                select: function( event, ui ) {
                    $('#response').val(ui.item.id);
                }
            });
        });
    </script>
@stop
@endsection