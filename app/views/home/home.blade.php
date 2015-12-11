@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')        
        <!--<li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-adjust"></span></a></li>-->
	   
@stop

@section('nombrevista')
    @lang('Home')
@stop

@section('contenido')
    {{Session::get('user_username')}}
    {{'/'}}
    {{Session::get('user_type')}}
    {{'/'}}
    {{Session::get('user_id')}}
    {{'/'}}
    {{Session::get('user_estado')}}
    
@stop

