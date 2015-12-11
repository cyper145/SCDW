@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
  <li>
    <a href="{{ URL::to( '/jugador_juego');}}">Jugador en juego</a>
  </li>   
@stop

@section('nombrevista')
    Lista de Jugadores en juego
@stop
<!-- inicio: CONTENIDO -->
@section('contenido')
	<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="clip-users-2"></i>Lista de jugadores en juego
				<div class="panel-tools pull-right">
					<a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
					<a class="btn btn-sm btn-info btn-tool" href="jugador_juego/create">
						<i class="glyphicon glyphicon-plus"></i> Agregar jugador en juego
					</a>
				</div>
			</div>
            <div class="panel-body">
                @include('alerts.success')
                <table class="table  table-bordered table-hover" id="lista_jugadores" rel="">
                    <thead>
						<th class="center">Nro de Camiseta</th>
                        <th>Condiciones en partido</th>
                        <th>Es Capitan</th>
                        <th class="text-center">Acción</th>
                    </thead>
					@if ($jugador_juego == true)
						@foreach ($jugador_juego as $itemJugadorJuego)
                            <tr id="{{ $itemJugadorJuego->idjugadorenjuego }}" >
								<td class="center">
									{{ $itemJugadorJuego->nrocamiseta }}
								</td>
                                <td>{{ $itemJugadorJuego->condicionenpartido }}</td>
                                <td class="text-center">{{ ($itemJugadorJuego->escapitan == "si")?'<i style="color:#23BF25;" class="glyphicon glyphicon-ok"></i>':'<i style="color:#F9243F;" class="glyphicon glyphicon-remove"></i>' }}</td>

                                <td class="text-center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a href="{{ route('jugador_juego.edit',array($itemJugadorJuego->idjugadorenjuego)) }}" class="btn btn-xs btn-primary" data-placement="top" data-
                                        original-title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                                        {{ Form::open(array('route' => array('jugador_juego.destroy', $itemJugadorJuego->idjugadorenjuego), 'method' => 'delete',"class"=>'col-md-1')) }}
                                            <button type="submit" onclick="return confirm('¿Estas seguro de eliminar este item?')"  class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                        {{ Form::close() }}
                                    </div>
                                </td>
                            </tr>
					@endforeach
				@endif
                </table>
                <div class="text-center">
                    {{ $jugador_juego->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- fin: CONTENIDO -->
