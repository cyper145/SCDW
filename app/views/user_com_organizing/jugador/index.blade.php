@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
  <li>
    <a href="{{ URL::to( '/jugador');}}">Jugador</a>
  </li>   
@stop

@section('nombrevista')
    Lista de Jugadores
@stop
<!-- inicio: CONTENIDO -->
@section('contenido')
	<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="clip-users-2"></i>{{Session::get('user_name')}}
				<div class="panel-tools pull-right">
                    <div class="form-inline">
                        {{ Form::open(array('url' => '#','method' => 'post')) }}
                        <div class="form-group">

                            <a class="btn btn-danger margin text-lowercase text-capitalize" type="button" href="#"><span class="glyphicon glyphicon-list-alt"></span>PDF</a>
                            <a class="btn btn-info margin text-lowercase" type="button" href="jugador/create"><span class="glyphicon glyphicon-plus"></span> Add New</a>
                            <label class="label"><span class="glyphicon glyphicon-search"></span></label>
                            <input type="text" class="form-control" name="valor" placeholder="Buscar por Codigo" maxlength="5" readonly>
                        </div>
                        {{Form::close()}}
                    </div>
				</div>
			</div>
            <div class="panel-body">
                @include('alerts.success')
                <table data-toggle="table" data-url="tabless/data2.json">
                    <thead class="text-center">
                        <th>Foto</th>
                        <th>DNI</th>
                        <th>Estado</th>
                        <th>Nombre de equipo</th>
                        <th>Nombre de jugador</th>
                        <th>Acción</th>
                    </thead>
					@if ($jugador == true)
						@foreach ($jugador as $itemJugador)
                            <tr id="{{ $itemJugador->dni }}" >
								<td class="center">
									<a class="btn btn-xs btn-info" href="JavaScript:window.open('../storage/jugador/{{ $itemJugador->foto }}','popUpWindow','height=300,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes');"><i class="glyphicon glyphicon-picture"></i> ver</a>
								</td>
                                <td>{{ $itemJugador->dni }}</td>
                                <td>{{ $itemJugador->estado }}</td>
                                <td>{{ $itemJugador->dataEquipo[0]->nombre }}</td>
                                <td>{{ $itemJugador->dataDocente[0]->apellidopaterno.' '.$itemJugador->dataDocente[0]->apellidomaterno.', '.$itemJugador->dataDocente[0]->nombre }}</td>
                                <td class="text-center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a href="{{ route('jugador.edit',array($itemJugador->dni)) }}" class="btn btn-xs btn-primary" data-placement="top" data-
                                        original-title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                                        {{ Form::open(array('route' => array('jugador.destroy', $itemJugador->dni), 'method' => 'delete',"class"=>'col-md-1')) }}
                                            <button type="submit" onclick="return confirm('¿Estas seguro de eliminar este item?')" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                        {{ Form::close() }}
                                    </div>
                                </td>
                            </tr>
					@endforeach
				@endif
                </table>
                <div class="text-center">
                    {{ $jugador->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection
