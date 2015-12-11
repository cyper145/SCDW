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
    Agregando Jugador en juego
@stop
<!-- inicio: CONTENIDO -->
@section('contenido')
	<div class="row">
        <div class="col-sm-12">
        	@include('alerts.request')
			{{ Form::open(['route'=>'jugador_juego.store', 'method'=>'POST',"enctype"=>"multipart/form-data","autocomplete" => "off","novalidate"=>"novalidate"]) }}
			<div class="panel panel-default">
				<div class="panel-heading">Agregar Jugador en juego</div>
				<div class="panel-body">
            		@include('user_com_organizing.jugador_juego.forms.jugador_juego')
            	</div>
            </div>
            <!-- ENVIO  -->
			<div class="row">
				<div class="col-md-9">
					<p></p>
				</div>
				<div class="col-md-3">
					{{ link_to_route('jugador_juego.index', $title = 'Cancelar', $parameters = array(), array('class'=>'btn btn-danger')) }}
					{{ Form::submit('Agregar',array('class'=>'btn btn-primary')) }}
				</div>
			</div>
			{{ Form::token() }}
            {{ Form::close() }}
        </div>
    </div>
@endsection
<!-- fin: CONTENIDO -->
<!-- inicio:SCRIPTS -->
@section('scripts')
    <script src="{{asset('#')}}"></script>
@endsection
<!-- fin:SCRIPTS -->
