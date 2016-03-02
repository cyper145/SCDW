




<div class="form_contenido">
    <div id="step-1">
        <div class="row">
            <div class="row col-no-gutter-container">
                <div class="col-xs-6 col-md-2 col-no-gutter">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <div>
                                {{ HTML::image('storage/equipo/'.$fixture->dataEquipo1[0]->logo,'Image Empty',['class'=>'img-responsive','title'=>'logo del equipo '.$fixture->dataEquipo1[0]->nombre,'style'=>'width:155px;height: 155px']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-2 col-no-gutter pull-right">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <div>
                                {{ HTML::image('storage/equipo/camiseta/'.$fixture->dataEquipo1[0]->fotouniforme,'Image Empty',['class'=>'img-responsive','title'=>'Camiseta del equipo '.$fixture->dataEquipo1[0]->nombre,'style'=>'width:155px;height: 155px']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="panel-heading">Planilla de jugadores
            <div class="panel-tools pull-right">
                <div class="form-inline">
                    <div class="form-group">
                        {{Form::open(array('method' => 'POST', 'url' => '/fechas/'.$codcampeonato.'/'.$torneo->idtorneo.'/'.$idfecha.'/'.$partido->codpartido.'/partido.html/planilla/'.$fixture->dataEquipo1[0]->codequipo, 'role' => 'form'))}}

                        <div class="form-group">
                            <p>{{Form::submit('PDF', array('class' => 'btn btn-primary'))}}</p>
                        </div>

                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body panel-footer">
            <div class="row">
                <div class="row col-no-gutter-container">
                    @foreach($Delanteros1 as $jugadorenjuego)
                        <div class="col-xs-6 col-md-2 col-no-gutter">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    @if($jugadorenjuego->escapitan == 'si')
                                        <span class="glyphicon glyphicon-bookmark" title="Capitan"><span class="text-lowercase"> capitán</span> Delantero</span>
                                    @else
                                        Delantero
                                    @endif
                                </div>
                                <div class="panel-body easypiechart-panel">
                                    <div >
                                        {{ HTML::image('storage/jugador/'.$jugadorenjuego->foto,'Image Empty',['class'=>'img-responsive','title'=>'Foto del jugador','style'=>'width:150px;height: 150px']) }}
                                        {{$jugadorenjuego->apellidopaterno}}({{$jugadorenjuego->nrocamiseta}})
                                    </div>
                                    <a class="label label-success" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                    </a><br>
                                    <a class="label label-primary" href="{{$jugadorenjuego->idjugadorenjuego}}/goles.html" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Gol
                                    </a><br>
                                    <a class="label label-warning" href="{{$jugadorenjuego->idjugadorenjuego}}/tarjeta.html" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Tarjeta
                                    </a><br>
                                    <a class="label label-info" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Insidencia
                                    </a><br>
                                    <a class="label label-danger" href="{{$jugadorenjuego->idjugadorenjuego}}/eliminar.html">
                                        <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><br>

            <div class="row">
                <div class="row col-no-gutter-container">
                    @foreach($Mediocampistas1 as $jugadorenjuego)
                        <div class="col-xs-6 col-md-2 col-no-gutter">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    @if($jugadorenjuego->escapitan == 'si')
                                        <span class="glyphicon glyphicon-bookmark" title="Capitan"><span class="text-lowercase"> capitán</span> Mediocpta</span>
                                    @else
                                        Mediocpta
                                    @endif
                                </div>
                                <div class="panel-body easypiechart-panel">
                                    <div >
                                        {{ HTML::image('storage/jugador/'.$jugadorenjuego->foto,'Image Empty',['class'=>'img-responsive','title'=>'Foto del jugador','style'=>'width:150px;height: 150px']) }}
                                        {{$jugadorenjuego->apellidopaterno}}({{$jugadorenjuego->nrocamiseta}})
                                    </div>
                                    <a class="label label-success" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                    </a><br>
                                    <a class="label label-primary" href="{{$jugadorenjuego->idjugadorenjuego}}/goles.html" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Gol
                                    </a><br>
                                    <a class="label label-warning" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Tarjeta
                                    </a><br>
                                    <a class="label label-info" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Insidencia
                                    </a><br>
                                    <a class="label label-danger" href="{{$jugadorenjuego->idjugadorenjuego}}/eliminar.html">
                                        <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><br>

            <div class="row">
                <div class="row col-no-gutter-container">
                    @foreach($Defensas1 as $jugadorenjuego)
                        <div class="col-xs-6 col-md-2 col-no-gutter">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    @if($jugadorenjuego->escapitan == 'si')
                                        <span class="glyphicon glyphicon-bookmark" title="Capitan"><span class="text-lowercase"> capitán</span> Defensa</span>
                                    @else
                                        Defensa
                                    @endif
                                </div>
                                <div class="panel-body easypiechart-panel">
                                    <div >
                                        {{ HTML::image('storage/jugador/'.$jugadorenjuego->foto,'Image Empty',['class'=>'img-responsive','title'=>'Foto del jugador','style'=>'width:150px;height: 150px']) }}
                                        {{$jugadorenjuego->apellidopaterno}}({{$jugadorenjuego->nrocamiseta}})
                                    </div>
                                    <a class="label label-success" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                    </a><br>
                                    <a class="label label-primary" href="{{$jugadorenjuego->idjugadorenjuego}}/goles.html" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Gol
                                    </a><br>
                                    <a class="label label-warning" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Tarjeta
                                    </a><br>
                                    <a class="label label-info" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Insidencia
                                    </a><br>
                                    <a class="label label-danger" href="{{$jugadorenjuego->idjugadorenjuego}}/eliminar.html">
                                        <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><br>

            <div class="row">
                <div class="row col-no-gutter-container">
                    @foreach($Guardameta1 as $jugadorenjuego)
                        <div class="col-xs-6 col-md-2 col-no-gutter">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    @if($jugadorenjuego->escapitan == 'si')
                                        <span class="glyphicon glyphicon-bookmark" title="Capitan"><span class="text-lowercase"> capitán</span> Arquero</span>
                                    @else
                                        Arquero
                                    @endif
                                </div>
                                <div class="panel-body easypiechart-panel">
                                    <div >
                                        {{ HTML::image('storage/jugador/'.$jugadorenjuego->foto,'Image Empty',['class'=>'img-responsive','title'=>'Foto del jugador','style'=>'width:150px;height: 150px']) }}
                                        {{$jugadorenjuego->apellidopaterno}}({{$jugadorenjuego->nrocamiseta}})
                                    </div>
                                    <a class="label label-success" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                    </a><br>
                                    <a class="label label-primary" href="{{$jugadorenjuego->idjugadorenjuego}}/goles.html" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Gol
                                    </a><br>
                                    <a class="label label-warning" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Tarjeta
                                    </a><br>
                                    <a class="label label-info" href="#" >
                                        <span class="glyphicon glyphicon-list"></span> &nbsp;Insidencia
                                    </a><br>
                                    <a class="label label-danger" href="{{$jugadorenjuego->idjugadorenjuego}}/eliminar.html">
                                        <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><br>
        </div>
    </div>
</div>

<div class="panel-body panel-footer">
    <div id="step-1 ">
        <div class="row">
            <div class="row col-no-gutter-container">
                @foreach($suplentes1 as $jugadorenjuego)
                    <div class="col-xs-6 col-md-2 col-no-gutter">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                @if($jugadorenjuego->escapitan == 'si')
                                    <span class="glyphicon glyphicon-bookmark" title="Capitan"><span class="text-lowercase"> capitán</span> Suplente</span>
                                @else
                                    Suplente
                                @endif
                            </div>
                            <div class="panel-body easypiechart-panel">
                                <div >
                                    {{ HTML::image('storage/jugador/'.$jugadorenjuego->foto,'Image Empty',['class'=>'img-responsive','title'=>'Foto del jugador','style'=>'width:150px;height: 150px']) }}
                                    {{$jugadorenjuego->apellidopaterno}}({{$jugadorenjuego->nrocamiseta}})
                                </div>
                                <a class="label label-success" href="#" >
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Detail
                                </a><br>
                                <a class="label label-primary" href="{{$jugadorenjuego->idjugadorenjuego}}/goles.html" >
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Gol
                                </a><br>
                                <a class="label label-warning" href="#" >
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Tarjeta
                                </a><br>
                                <a class="label label-info" href="#" >
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;Insidencia
                                </a><br>
                                <a class="label label-danger" href="{{$jugadorenjuego->idjugadorenjuego}}/eliminar.html">
                                    <span class="glyphicon glyphicon-trash">&nbsp;Delete</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div><br>
    </div>
</div>
<div class="panel-footer">
    <div class="col-md-3">
        {{ Form::open(array('url'=>'fechas/detail/partido/jugador/add.html','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
        {{ Form::hidden('codpartido',$partido->codpartido) }}
        {{ Form::hidden('idtorneo',$torneo->idtorneo) }}
        {{ Form::hidden('codcampeonato',$codcampeonato) }}
        {{ Form::hidden('idfecha',$idfecha )}}
        {{ Form::hidden('idfixture',$fixture->idfixture) }}
        <div class="form-group">
            {{ Form::label('dni', 'Jugador',array("class"=>"control-label")) }}
            <select  class="form-control" name="jugador">
                @foreach( $jugadoresequipo1 as $val)
                    <option class="form-control" value="{{$val->idjugador}}">{{$val->dataDocente[0]->apellidopaterno}} {{$val->dataDocente[0]->apellidomaterno}} {{$val->dataDocente[0]->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('dni', 'Condicion',array("class"=>"control-label")) }}
            <select  class="form-control" name="condicion">
                <option class="form-control" value="delantero">Delantero</option>
                <option class="form-control" value="mediocampista">Mediocampista</option>
                <option class="form-control" value="guardameta">Guardameta</option>
                <option class="form-control" value="defensa">Defensa</option>
                <option class="form-control" value="suplente">Suplente</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('dni', 'Camiseta',array("class"=>"control-label")) }}
            {{ Form::text('camiseta',null,["class"=>"required form-control","maxlength"=>"2"]) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('dni', 'Es campitan?',array("class"=>"control-label")) }}
            <select  class="form-control" name="escapitan">
                <option class="form-control" value="no">No</option>
                <option class="form-control" value="si">Si</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group"><br>
            {{ Form::submit('Agregar',['class' => 'btn btn-primary'])}}
        </div>
    </div>
    {{ Form::close()}}
</div>