@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
@stop

@section('nombrevista')
    @lang('Bienvenido al Campeonato de Futbol Inter Docentes UNSAAC')
@stop

@section('contenido')
    {{HTML::image('bg/campeonato.png','imagen uniforme',['class'=>'img-responsive','title'=>'uniforme','style'=>'width: 1000px'])}}
@stop