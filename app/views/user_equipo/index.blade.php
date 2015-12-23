@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
@stop

@section('nombrevista')
    @lang('Home')
@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allsuccess')
    @include('alerts.success')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="col-md-3 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading text-center">Logo</div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <div class="col-lg-3">
                        @if($equipo->logo != '')
                            {{HTML::image('storage/equipo/'.$equipo->logo,'imagen logo',['class'=>'img-responsive','title'=>'uniforme','style'=>'width: 200px'])}}
                            <a class="btn btn-danger  margin" type="button" href="{{URL::to('jugador/logo/delete.html')}}"><span class="glyphicon glyphicon-trash"> Eliminar</span></a>
                        @else
                            <span class="label label-info">sin Logo</span>
                            <a class="btn btn-primary btn-circle margin" type="button" href="{{URL::to('jugador/logo.html')}}"><span class="glyphicon glyphicon-plus"></span></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading text-center">Camiseta</div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <div class="col-lg-3">
                        @if($equipo->fotouniforme != '')
                            {{HTML::image('storage/equipo/camiseta/'.$equipo->fotouniforme,'imagen uniforme',['class'=>'img-responsive','title'=>'uniforme','style'=>'width: 200px'])}}
                            <a class="btn btn-danger  margin" type="button" href="{{URL::to('jugador/camiseta/delete.html')}}"><span class="glyphicon glyphicon-trash"> Eliminar</span></a>
                        @else
                            <span class="label label-info">sin uniforme</span>
                            <a class="btn btn-primary btn-circle margin" type="button" href="{{URL::to('jugador/camiseta.html')}}"><span class="glyphicon glyphicon-plus"></span></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
        <div class="panel panel-teal panel-widget">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left "> Listar
                    <a class="color-blue" href="{{URL::to('jugador/listar.html')}}"><span class="glyphicon glyphicon-user glyphicon-l"></span></a>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <div class="large">{{$nrojugadores}}</div>
                    <div class="text-muted">
                        @if($nrojugadores=='1')
                            Jugador
                        @else
                            Jugadores
                        @endif
                        <a class="widget-right" href="{{URL::to('jugadorinsertar')}}">
                            <button class="btn btn-default margin" type="button">
                                <span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Nuevo
                            </button>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>

@stop