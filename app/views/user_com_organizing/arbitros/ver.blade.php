@extends('_templates.apptemp')

@section('sidebar')
     @parent
     Información de arbitro
@stop

@section('content')
    {{ HTML::link('arbitros', 'Volver'); }}
    <h1>Arbitro {{$arbitros->coddocente}}</h1>
    {{ $usuario->nombre}}
    <br />
    {{ $arbitros->created_at}}
@stop