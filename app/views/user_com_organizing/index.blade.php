@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><span class="glyphicon glyphicon-home"></span></li>
@stop

@section('nombrevista')
    @lang('comison organizadora')
@stop

@section('contenido')
    <div class="col-xs-12 col-md-6 col-lg-3 col-no-gutter">
        <div class="panel panel-teal panel-widget">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left">
                    <a href="integrantes/list.html">
                            <span class="glyphicon glyphicon-user glyphicon-l"></span>
                    </a>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <div class="large">{{$nrointegrantess}}</div>
                    <div class="text-muted">
                        @if($nrointegrantess=='1')
                            Integrante
                        @else
                            Integrantes
                        @endif
                        <a class="widget-right" href="{{URL::to('comisionintegrantesadd')}}">
                            <button class="btn btn-primary margin" type="button">
                                <span class="glyphicon glyphicon-plus"></span> &nbsp;Agregar Nuevo
                            </button>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@stop