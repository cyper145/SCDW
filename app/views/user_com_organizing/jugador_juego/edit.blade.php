  @extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
  <li>
    <a href="{{ URL::to( '/jugador_juego');}}">Jugador</a>
  </li>   
@stop

@section('nombrevista')
    Actualizando Jugador en juego
@stop
<!-- inicio: CONTENIDO -->
@section('contenido')
	<div class="row">
        <div class="col-sm-12">
        	@include('alerts.request')
			{{Form::model($jugador_juego,['route'=> ['jugador_juego.update',$jugador_juego->idjugadorenjuego],'method'=>'PUT','files' => true])}}
			<div class="panel panel-default">
				<div class="panel-heading">Editar Jugador en juego</div>
				<div class="panel-body">
            		@include('user_com_organizing.jugador_juego.forms.jugador_juego')
            	</div>
            </div>
			<hr>
			<div class="row">
				<div class="col-md-3">
					{{ link_to_route('jugador_juego.index', $title = 'Cancelar', $parameters = array(), array('class'=>'btn btn-danger')) }}
					{{ Form::submit('Actualizar',array('class'=>'btn btn-primary')) }}
				</div>
			</div>
			{{ Form::token() }}
            {{ Form::close()}}
        </div>
    </div>
    <!-- SCRIPT -->
@endsection
<!-- fin: CONTENIDO -->
