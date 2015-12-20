@if($partido->idarbitroporpartido == '')
    <div class="col-md-12 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading">Ingrese los Arbitros del partido</div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <div class="col-md-12">
                        {{ Form::open(array('url'=>'fechas/detail/partido/arbitros/add.html','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                        <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                        {{ Form::hidden('idtorneo',$torneo->idtorneo) }}
                        {{ Form::hidden('codcampeonato',$codcampeonato) }}
                        {{ Form::hidden('idfecha',$idfecha )}}
                        {{ Form::hidden('idfixture',$fixture->idfixture) }}
                        {{ Form::hidden('codpartido',$partido->codpartido) }}
                        <label>Arbitro Principal</label>
                        <select  class="form-control" name="principal">
                            @foreach( $arbitros as $val)
                                <option class="form-control" value="{{$val->dni}}">{{$val->dni}} {{$val->nombre}} {{$val->Apellidos}}</option>
                            @endforeach
                        </select>
                        <label>Asistente 1</label>
                        <select  class="form-control" name="asistente1">
                            @foreach( $arbitros as $val)
                                <option class="form-control" value="{{$val->dni}}">{{$val->dni}} {{$val->nombre}} {{$val->Apellidos}}</option>
                            @endforeach
                        </select>
                        <label>Asistente 2</label>
                        <select  class="form-control" name="asistente2">
                            @foreach( $arbitros as $val)
                                <option class="form-control" value="{{$val->dni}}">{{$val->dni}} {{$val->nombre}} {{$val->Apellidos}}</option>
                            @endforeach
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        {{ Form::close()}}
                        <!-- END CONTENIDO DEL FORMULARIO -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class="glyphicon glyphicon-asterisk" title="jajaja wilson"></span>
@else
    <div class="col-md-12 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading">Arbitros del partido</div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <div class="col-md-12">
                        <strong class="primary-font">Arbitro Principal:<br> </strong><span class="text-primary">
                                    {{$arbitrosdelpartido->DataArbitroPrincipal[0]->nombre}}
                            {{$arbitrosdelpartido->DataArbitroPrincipal[0]->Apellidos}}
                            ({{$arbitrosdelpartido->DataArbitroPrincipal[0]->dni}})
                                    ({{$arbitrosdelpartido->DataArbitroPrincipal[0]->edad}} años)</span><br>
                        <strong class="primary-font">Asistente 1:<br> </strong><span class="text-primary">
                                    {{$arbitrosdelpartido->DataArbitroAsistente1[0]->nombre}}
                            {{$arbitrosdelpartido->DataArbitroAsistente1[0]->Apellidos}}
                            ({{$arbitrosdelpartido->DataArbitroAsistente1[0]->dni}})
                                    ({{$arbitrosdelpartido->DataArbitroAsistente1[0]->edad}} años)</span><br>
                        <strong class="primary-font">Asistente 2:<br> </strong><span class="text-primary">
                                    {{$arbitrosdelpartido->DataArbitroAsistente2[0]->nombre}}
                            {{$arbitrosdelpartido->DataArbitroAsistente2[0]->Apellidos}}
                            ({{$arbitrosdelpartido->DataArbitroAsistente2[0]->dni}})
                                    ({{$arbitrosdelpartido->DataArbitroAsistente2[0]->edad}} años)</span><br>
                    </div>
                </div>
            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
    <span class="glyphicon glyphicon-asterisk" title="jajaja wilson"></span>
@endif