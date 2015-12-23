@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li><a href="{{ URL::to('/campeonato/detail/'.$codcampeonato);}}">Detalle de Campeonato</a></li>
    <li><a href="{{ URL::to('/torneo/'.$codcampeonato);}}">Torneos</a></li>
    <li><a href="{{ URL::to('/torneo/'.$torneo->idtorneo.'/'.$codcampeonato.'/detail.html');}}">Detalle del torneo {{$torneo->tipo}}</a></li>
    <li><a href="{{ URL::to('/fechas/'.$torneo->idtorneo.'/'.$codcampeonato.'/'.$idfecha.'/detail.html');}}">Detalle de fecha</a></li>
    <li>Partido de {{$fixture->dataEquipo1[0]->nombre.' vs '.$fixture->dataEquipo2[0]->nombre}}</li>
@stop

@section('nombrevista')
    @lang('Partido: '.$fixture->dataEquipo1[0]->nombre.' vs '.$fixture->dataEquipo2[0]->nombre)
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
                <strong class="primary-font">Hora de inicio: </strong><span class="text-primary">{{$partido->horainicio}}</span><br>
                <strong class="primary-font">Hora de finalizacion: </strong><span class="text-primary">{{$partido->horafin}}</span><br>
                <strong class="primary-font">Tipo de partido: </strong><span class="text-primary">{{$partido->tipopartido}}</span><br>
                <strong class="primary-font">Observaciones: </strong><span class="text-primary">{{$partido->observacion}}</span><br>
            </div>
            <div class="panel panel-footer">
                @if($partido->idarbitroporpartido == '')
                    <a class="btn btn-primary" href="#addarbitro">Agregar Arbitros de este partido</a>
                @endif
                <a class="btn btn-info" href="#tab4" data-toggle="tab">otros</a>
            </div>
        </div>
    </div>

    <div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body tabs">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Equipo 1 : {{$fixture->dataEquipo1[0]->nombre}}</a></li>
                        <li><a href="#tab2" data-toggle="tab">Equipo 2 : {{$fixture->dataEquipo2[0]->nombre}}</a></li>
                        <li><a href="#tab3" data-toggle="tab">Arbitros</a></li>
                        <li><a href="#tab4" data-toggle="tab">Targetas</a></li>
                        <li><a href="#tab5" data-toggle="tab">Cambios</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1">
                            @include('user_com_organizing.fecha.partido.tabs.tab1')
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <h4>Equipo 2 : {{$fixture->dataEquipo2[0]->nombre}}</h4>
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            @include('user_com_organizing.fecha.partido.tabs.tab3')
                        </div>
                        <div class="tab-pane fade" id="tab4">
                            <h4>Tab 3</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget rutrum purus. Donec hendrerit ante ac metus sagittis elementum. Mauris feugiat nisl sit amet neque luctus, a tincidunt odio auctor. </p>
                        </div>
                        <div class="tab-pane fade" id="tab5">
                            <h4>Tab 3</h4>
                            @include('user_com_organizing.fecha.partido.tabs.tab5')
                        </div>
                    </div>
                </div>
            </div><!--/.panel-->
        </div>
    </div>

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection