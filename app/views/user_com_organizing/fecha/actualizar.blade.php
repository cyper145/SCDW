@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <div class="container" id="pesta"></div>
	<li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-home"></span></a>
    <li><a href="{{ URL::to( '/torneo/'.$idcampeonato.'/'.$torneo->codRueda.'/detail.html#fixture');}}"><span class="glyphicon glyphicon-link"></span></a></li>
@stop

@section('nombrevista')
    @lang('actualizar las fechas')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop
@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allerrors')
    @include('alerts.errors')
    <!-- END PARA MANEJO DE ERRORES -->
    @if(!$fechaexiste = Fechas::where('nroFecha', '=',$nrofecha )->where('codRueda','=',$torneo->codRueda)->first())
        <div class="row col-no-gutter-container">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">actualizacion de fecha {{$nrofecha}}</div>
					<div class="panel-body">
						<div class="col-md-6">
							  {{ Form::open(array('url' => 'fecha/edit/'.$idcampeonato.'/'.$torneo->codRueda.'/add','method' => 'post', 'files' => true, 'class' => 'form-inline')) }}
                            {{Form::hidden('nrofecha',$nrofecha)}}
                            <div class="form-group">
                                {{ Form::label('fecha')}}
                                {{ Form::date('fecha', null, array('type' => 'text','required', 'class' => 'form-control ','readonly','placeholder' => '2015-12-21')) }}
                                <span class="help-block">{{ $errors->first('fecha') }}</span>
                            </div>
                            <div class="form-group">
                                {{ Form::label('hora inicio')}}
                                {{Form::time('horainicio','',array('class' => 'form-control','required','placeholder' => 'hh:mm:ss'))}}
                                <span class="help-block">{{ $errors->first('horainicio') }}</span>
                            </div>
                            <div class="row">
                            <div class="form-group">
                                <p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
                            </div>
                            </div>
							{{ Form::close() }}
							</div>

					</div>
				</div>
			</div>
        </div>
    @endif
    <?php $fechaexiste = Fechas::where('nroFecha', '=',$nrofecha )->where('codRueda','=',$torneo->codRueda)->first();?>

    @if(  $fechaexiste = Fechas::where('nroFecha', '=',$nrofecha )->where('codRueda','=',$torneo->codRueda)->first())
        <?php $fixturefecha=Fixture::where('nroFecha', '=',$nrofecha )->where('codRueda','=',$torneo->codRueda)->get(); ?>
        <div class="row row-no-gutter col-no-gutter-container" id="fecha">
            <div class="col-md-12 col-no-gutter ">
                <div class="panel panel-default">
                    <div class="panel-heading">PROGRAMAR PARTIDOS DE LA FECHA {{$nrofecha}}
                    </div>
                    <!-- BEGIN PARA MANEJO DE ERRORES -->
                    @include('alerts.allerrors')
                    @include('alerts.errors')
                    <!-- END PARA MANEJO DE ERRORES -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">

                                <table data-toggle="table" data-url="tables/data2.json">
                                    <thead>
                                    <tr>
                                        <th>fecha</th>
                                        <th>equipo1</th>
                                        <th>equipo2</th>
                                        <th>hora</th>
                                        <th>acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fixturefecha as $val)
                                        <tr>
                                            <td>{{$val->nroFecha}}</td>
                                            <td>{{Equipo::find($val->codEquipo1)->nombre}}</td>
                                            <td>{{Equipo::find($val->codEquipo2)->nombre}}</td>
                                            <td>{{$val->hora}}</td>
                                            <td>
                                                @if(!$nro=Programacion::where('nroPartido', '=', $val->nroPartido)->where('idFecha', '=', $fechaexiste->idFecha)->first())
                                                <a href="programacion/{{$val->codFixture}}" class="btn btn-info label label-info">
                                                    <span class="glyphicon glyphicon-edit"></span> Programar partido
                                                </a>
                                                @else
                                                <label  class="label label-warning">
                                                    <span class="glyphicon glyphicon-arrow-up"></span> partido Programado
                                                </label>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-success" href="#">Aceptar</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
    @endif
@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection