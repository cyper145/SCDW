@extends('_templates.apptemp')

@section('sidebar')
     @parent
     Lista de arbitros
@stop

@section('content')
        <h1>Arbitros</h1>
        {{ HTML::link('arbitros/nuevo', 'Crear arbitro'); }}

<ul>
  @foreach($arbitros as $arbitro)
        <li>{{ HTML::link( 'arbitros/'.$usuario->dni , $usuario->nombre ) }}</li>
    @endforeach
</ul>
@stop