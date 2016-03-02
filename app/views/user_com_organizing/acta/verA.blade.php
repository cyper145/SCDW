@extends('_templates.apptemp')

@section('titulo')
    @lang('acta')
@stop

@section('rutanavegacion')        

@stop

@section('nombrevista')
    @lang('Acta de reunion ')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop



@section('contenido')
<?php
$conclusiones=DB::select('select * from tagenda where codReunion=?',array($buscar));
$arr3=array();
foreach ($conclusiones as $user)
{
    $arr3[$user->codAgenda] = $user->tema;
}

?>


<!-- cabecera-->
<div class="row col-lg-12">
    <div class="col-lg-12 col-no-gutter">
        <div class="panel panel-primary">
            <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Informacion de acta: </div>
            <div class="panel-body">
                <strong class="primary-font">fecha de reunion: </strong><span class="text-primary">{{$category->fecha}}</span><br>
                <strong class="primary-font">reunion de la  </strong><span class="text-primary">{{"fecha ".Fechas::find($category->idFecha)->nroFecha}}</span><br>

            </div>
            <div class="panel panel-footer">

                <a class="btn btn-info" href="#asistente">Asistencia</a>
                <a class="btn btn-info" href="#agenda">temas de agenda</a>
                <a class="btn btn-info" href="#conclusion">conclusiones de agendas</a>
            </div>
        </div>
    </div>
</div>
<br>
<!-- endcabecera -->

<!-- asistencia-->
<div class="row row-no-gutter col-no-gutter-container" id="asistente">
    <div class="col-md-12 col-no-gutter ">
        <div class="panel panel-default">
            <div class="panel-heading">Asistencia a la reunion
            </div>
            <!-- BEGIN PARA MANEJO DE ERRORES -->
            @include('alerts.allerrors')
            @include('alerts.errors')
            <!-- END PARA MANEJO DE ERRORES -->
            <div class="panel-body">
                <div class="row">
                <div class="col-md-6">

                    {{Form::open(array('method' => 'POST', 'url' => 'campeonato/detail/'.$codcampeonato.'/addasistencia/'.$buscar,'autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                    <div class="form-group" >
                        {{Form::label('lbldelegado','asistencia')}}
                        {{Form::text('delegado',Input::old('autdelegado'),['class'=>'form-control','placeholder'=>'ingrese delegado','id'=>'autdelegado'])}}
                    </div>

                    <div class="form-group">
                        <p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
                    </div>

                    {{Form::close()}}

                </div>

                <div class="col-md-6">

                <table data-toggle="table" data-url="tables/data2.json">
                            <thead>
                            <tr>
                                <th>codigo</th>
                                <th>nombre</th>
                                <th>rol</th>
                                <th>acciones</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($todoasistente as $cat)
                                <tr>
                                    <td>{{$cat->codDocente}}</td>
                                    <td>{{$cat->nombre." ".$cat->apellidoP." ".$cat->apellidoM}}</td>
                                    <td>{{$cat->rol}}</td>
                                    <td>

                                        <a href="{{$buscar}}/delete1/{{$cat->codAsistente}}" class="btn btn-default">
                                            <span class="glyphicon glyphicon-remove"></span> Eliminar
                                        </a>
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
<!-- endasistencia-->

<!-- agenda -->
<div class="row row-no-gutter col-no-gutter-container" id="agenda">
    <div class="col-md-12 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading">temas tratados
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        {{Form::open(array('method' => 'POST', 'url' => 'campeonato/detail/'.$codcampeonato.'/addagenda/'.$buscar, 'role' => 'form'))}}
                        <div class="form-group">
                            {{ Form::label('tema')}}
                            {{Form::text('tema', '',array('class' => 'form-control'))}}
                            <span class="help-block">{{ $errors->first('tema') }}</span>
                        </div>
                        <div class="form-group">
                            <p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
                        </div>
                        {{Form::close()}}
                    </div>
                    <div class="col-md-6">
                        <table data-toggle="table" data-url="tables/data2.json">
                            <thead>
                            <tr>
                                <th>nroAgenda</th>
                                <th>codAgenda</th>
                                <th>tema</th>
                                <th>acciones</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            ?>
                            @foreach($todoAgenda as $cat)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$cat->codAgenda}}</td>
                                    <td>{{$cat->tema}}</td>
                                    <td>

                                        <a href="{{$buscar}}/delete2/{{$cat->codAgenda}}" class="btn btn-default">
                                            <span class="glyphicon glyphicon-remove"></span> Eliminar
                                        </a>
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
<!-- endagenda -->

<!-- conclusion -->
<div class="row row-no-gutter col-no-gutter-container" id="conclusion">
    <div class="col-md-12 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading">conclusiones de los temas tratados
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        {{Form::open(array('method' => 'POST', 'url' => 'campeonato/detail/'.$codcampeonato.'/addconclusion/'.$buscar, 'role' => 'form'))}}
                        <div class="form-group">
                            {{ Form::label('tema')}}
                            {{Form::text('tema', '',array('class' => 'form-control'))}}
                            <span class="help-block">{{ $errors->first('tema') }}</span>
                        </div>
                        <div class="form-group">
                            {{ Form::label('agenda')}}
                            {{Form::select('codagenda', $arr3,'',array('class' => 'form-control'))}}
                            <span class="help-block">{{ $errors->first('agenda') }}</span>
                        </div>

                        <div class="form-group">
                            <p>{{Form::submit('agregar', array('class' => 'btn btn-primary'))}}</p>
                        </div>
                        {{Form::close()}}
                    </div>
                    <div class="col-md-6">
                        <table data-toggle="table" data-url="tables/data2.json">
                            <thead>
                            <tr>

                                <th>codAgenda</th>
                                <th>Conclusion</th>
                                <th>acciones</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($todoConclusion as $cat)
                                <tr>
                                    <td>{{$cat->codAgenda}}</td>
                                    <td>{{$cat->conclusion}}</td>
                                    <td>

                                        <a href="{{$buscar}}/delete3/{{$cat->codConclusion}}" class="btn btn-default">
                                            <span class="glyphicon glyphicon-remove"></span> Eliminar
                                        </a>
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
<!-- endconclusion-->

@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
    <script src="{{asset('/js/jquery-ui/jquery-ui.js')}}"></script>

    <script>
        $(function() {
            $("#autdelegado").autocomplete({
                source: "{{$buscar}}/autodelegado",
                minLength: 1,
                select: function( event, ui ) {
                    $('#response').val(ui.item.id);
                }
            });
        });
    </script>
@stop
@endsection