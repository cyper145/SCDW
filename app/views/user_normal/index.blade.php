@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-adjust"></span></a></li>
@stop

@section('nombrevista')
    @lang('INICIO. Bienvenido al sistema de campeonato de docentes UNSAAC')
@stop

@section('contenido')
    {{ $tablaposiones }}
@stop