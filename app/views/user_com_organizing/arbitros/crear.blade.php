@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.arbitro')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/arbitros/nuevo');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop

@section('nombrevista')
    @lang('Arbitros')
@stop

@section('contenido')

    {{ HTML::link('arbitros', 'volver'); }}
        <h1>Crear Arbitro</h1>
        {{ Form::open(array('url' => 'arbitros/crear')) }}
            {{Form::label('nombre', 'Nombre')}}
            {{Form::text('nombre', '')}}
            {{Form::label('dni', 'DNI')}}
            {{Form::text('dni', '')}}
            {{Form::submit('Guardar')}}
        {{ Form::close() }}
@stop
