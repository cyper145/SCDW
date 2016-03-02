@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.arbitro')
@stop

@section('rutanavegacion')        

@stop

@section('nombrevista')
    @lang('Acta de reunion')
    <button type="submit" class="btn btn-success pull-right" onclick="history.back()">Atras</button>
@stop

@section('contenido')


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


<div class="row row-no-gutter col-no-gutter-container" id="asistente">
    <div class="col-md-12 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading">Asistencia a la reunion
            </div>
            <div class="panel-body">
                <table data-toggle="table" data-url="tables/data2.json">
                    <thead>
                    <tr>
                        <th>codigo</th>
                        <th>nombre</th>
                        <th>rol</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($todoasistente as $cat)
                        <tr>
                            <td>{{$cat->codDocente}}</td>
                            <td>{{$cat->nombre." ".$cat->apellidoP." ".$cat->apellidoM}}</td>
                            <td>{{$cat->rol}}</td>
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

<div class="row row-no-gutter col-no-gutter-container" id="agenda">
    <div class="col-md-12 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading">temas tratados
            </div>
            <div class="panel-body">
                <table data-toggle="table" data-url="tables/data2.json">
                    <thead>
                    <tr>
                        <th>nroAgenda</th>
                        <th>codAgenda</th>
                        <th>tema</th>

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

<div class="row row-no-gutter col-no-gutter-container" id="conclusion">
    <div class="col-md-12 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading">conclusiones de los temas tratados
            </div>
            <div class="panel-body">
                <table data-toggle="table" data-url="tables/data2.json">
                    <thead>
                    <tr>

                        <th>codAgenda</th>
                        <th>Conclusion</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($todoConclusion as $cat)
                        <tr>
                            <td>{{$cat->codAgenda}}</td>
                            <td>{{$cat->conclusion}}</td>
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