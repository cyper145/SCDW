@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to('/campeonato/listar');}}"><span class="glyphicon glyphicon-book"></span></a></li>
    <li>Detalle de Campeonato</li>
@stop

@section('nombrevista')
    @lang('Detalles del equipo')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')
    <!--codigo php -->
    <!--fin codigo php -->

    <div class="row col-lg-12">
        <div class="col-lg-12 col-no-gutter">
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de Equipo</div>
                <div class="panel-body">
                    <strong class="primary-font">Nombre: </strong><span class="text-primary">{{Equipo::find($codequipo)->nombre}}</span><br>
                    <!-- === ver el logo y el uniforme-->
                    <strong class="primary-font">logo: </strong><span class="text-primary">{{Equipo::find($codequipo)->logo}}</span><br>
                    <strong class="primary-font">camiste: </strong><span class="text-primary">{{Equipo::find($codequipo)->coloresUniforme}}</span><br>
                    <strong class="primary-font">Estado: </strong><span class="text-primary">{{Equipo::find($codequipo)->estado}}</span><br>
                </div>
                <div class="panel panel-footer">
                    <a class="btn btn-info" href="#jugadores">ver jugadores</a>
                    <a class="btn btn-info" href="#delegados">delegados</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row row-no-gutter col-no-gutter-container" id="jugadores">
        <div class="col-md-12 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de jugadores

                </div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>codjugador</th>
                            <th>nombre y apellidos</th>
                            <th>estado</th>
                            <th>acciones</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jugadoresEquipo as $val)
                            <tr>
                                <td>{{$val->codDocente}}</td>
                                <td>{{$val->nombre." ".$val->apellidoP." ".$val->apellidoM}}</td>
                                <td>{{Jugador::find($val->dni)->estado}}</td>
                                <td>
                                {{ Form::open(array('url' => 'campeonato/detail/'.$codcampeonato.'/equipodetalle/'.$codequipo.'/'.$val->dni,'method' => 'post', 'class' => 'form-inline')) }}

                                <div class="form-group ">
                                     {{ Form::label('Habilitar','',array('class'=>'label label-success '))}}
                                    {{Form::radio('habilitado', 'habilitado',false,array('class'=>'form-control '))}}
                                    {{ Form::label('Desabilitar','',array('class'=>'label label-danger '))}}
                                    {{Form::radio('habilitado', 'desabilitado',true,array('class'=>'form-control '))}}

                                    <br>
                                </div>
                                <button type="submit" class="btn btn-primary">cambiar</button>
                                {{ Form::close() }}

                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success" href="#">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row row-no-gutter col-no-gutter-container" id="delegados">
        <div class="col-md-12 col-no-gutter">
            <div class="panel panel-default">
                <div class="panel-heading">Lista delegados

                </div>
                <div class="panel-body">
                    <table data-toggle="table" data-url="tables/data2.json">
                        <thead>
                        <tr>
                            <th>codjugador</th>
                            <th>nombre y apellidos</th>
                            <th>estado</th>
                            <th>rol</th>
                            <th>acciones</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($delegadosEquipo as $val)
                            <tr>
                                <td>{{$val->codDocente}}</td>
                                <td>{{$val->nombre." ".$val->apellidoP." ".$val->apellidoM}}</td>
                                <td>{{Delegado::find($val->dni)->estado}}</td>
                                <td> {{$val->rol}}</td>
                                <td>
                                    {{ Form::open(array('url' => 'campeonato/detail/'.$codcampeonato.'/equipodetalle/'.$codequipo.'/delegado/'.$val->dni,'method' => 'post', 'class' => 'form-inline')) }}

                                    <div class="form-group ">
                                        {{ Form::label('Habilitar','',array('class'=>'label label-success '))}}
                                        {{Form::radio('habilitado', 'habilitado',false,array('class'=>'form-control '))}}
                                        {{ Form::label('Desabilitar','',array('class'=>'label label-danger '))}}
                                        {{Form::radio('habilitado', 'desabilitado',true,array('class'=>'form-control '))}}

                                        <br>
                                    </div>
                                    <button type="submit" class="btn btn-primary">cambiar</button>
                                    {{ Form::close() }}

                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-success" href="#">Aceptar</a>
                </div>
            </div>
        </div>
    </div>
    <br>

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
@stop
@endsection
