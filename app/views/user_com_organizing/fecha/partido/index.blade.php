@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li><a href="{{ URL::to('/torneo/'.$codcampeonato);}}">Torneos</a></li>
    <li><a href="{{ URL::to('/torneo/'.$torneo->codRueda.'/'.$codcampeonato.'/detail.html');}}">Detalle del torneo {{$torneo->tipo}}</a></li>
    <li><a href="{{ URL::to('/fechas/'.$torneo->codRueda.'/'.$codcampeonato.'/'.$idfecha.'/detail.html');}}">Detalle de fecha</a></li>
    <li>Partido de {{$equipo1->nombre.' vs '.$equipo2->nombre}}</li>
@stop

@section('nombrevista')
    @lang('Partido: '.$equipo1->nombre.' vs '.$equipo2->nombre)
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allsuccess')
    @include('alerts.errors')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion del partido </div>
            <div class="panel-body">
                <strong class="primary-font">Fecha de partido: </strong><span class="text-primary">{{$programacion->diaPartido}}</span><br>
                <strong class="primary-font">Hora de inicio: </strong><span class="text-primary">{{$partido->horaInicio}}</span><br>
                <strong class="primary-font">Hora de finalizacion: </strong><span class="text-primary">{{$partido->horaFin}}</span><br>
                <strong class="primary-font">Tipo de partido: </strong><span class="text-primary">{{$partido->tipoPartido}}</span><br>
                <strong class="primary-font">Observaciones: </strong><span class="text-primary">{{$partido->observacion}}</span><br>
            </div>
        </div>
    </div>

    <div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body tabs">
                    <ul class="nav nav-tabs">

                        <!--======== programacion y envio de planillas a equipos   -->
                        @if(!($manenaProgramacion ))
                           <!--======== seleccion de arbitro   -->
                           <li><a class="active" href="#tab1" data-toggle="tab">arbitros</a></li>
                           @if($activarPlanilla=="")
                           <!--======== envio de planilla  -->
                           <li><a href="#tab2" data-toggle="tab">enviar plantilla</a></li>
                           @endif
                        @endif
                        @if($esdiaProgramacion)
                            @if($AH)
                            <!--======== equipo1   -->
                                    <li><a class="active" href="#tab3" data-toggle="tab">equipo 1:{{$equipo1->nombre}} </a></li>
                            <!--======== equipo2  -->
                                    <li><a href="#tab4" data-toggle="tab">equipo 2: {{$equipo2->nombre}}</a></li>
                            @endif
                            @if($HoraI)
                            <!--======== reprogramar   -->
                                    <li><a class="active" href="#tab5" data-toggle="tab">reprogramar</a></li>
                            <!--======== incidencias  -->
                                    <li><a href="#tab6" data-toggle="tab">incidencias</a></li>
                            <!--======== informe del arbitro  -->
                                    <li><a href="#tab7" data-toggle="tab">informe de arbitro</a></li>
                            @endif
                        @endif
                    </ul>
                    <div class="tab-content">
                        @if(!($manenaProgramacion ))
                            <!--======== seleccion de arbitro   -->
                            <div class="tab-pane fade in active" id="tab1">
                                <!-- -->
                                @include('user_com_organizing.fecha.partido.tabs.tab1')

                            </div>
                            @if($activarPlanilla=="")
                                <!--======== envio de planilla  -->
                                <div class="tab-pane fade" id="tab2">
                                    <!-- -->
                                    @include('user_com_organizing.fecha.partido.tabs.tab2')
                                </div>
                            @endif
                        @endif
                            @if($esdiaProgramacion)
                                @if($AH)
                                    <!--======== equipo1   -->
                                    <div class="tab-pane fade in active" id="tab1">
                                        <!-- -->
                                        loco
                                    </div>
                                    <!--======== equipo2  -->
                                    <div class="tab-pane fade" id="tab1">
                                        <!---->
                                        loco
                                    </div>
                                @endif
                                @if($HoraI)
                                    <!--======== reprogramar   -->
                                        <div class="tab-pane fade in active" id="tab1">
                                            <!-- -->
                                            loco
                                        </div>
                                    <!--======== incidencias  -->
                                        <div class="tab-pane fade" id="tab1">
                                            <!-- -->
                                            loco
                                        </div>
                                    <!--======== informe del arbitro  -->
                                        <div class="tab-pane fade" id="tab1">
                                            <!-- -->
                                            loco
                                        </div> @endif
                            @endif
                    </div>
                </div>
            </div><!--/.panel-->
        </div>
    </div>

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection