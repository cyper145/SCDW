@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( '/home');}}"><span class="glyphicon glyphicon-adjust"></span></a></li>
@stop

@section('nombrevista')
    @lang('Tabla de Posiciones')
@stop

@section('contenido')



        <!--/.main-->
    <div class="container">
    <div class="row">
    <div class=" col-md-11" id="posiciones">
        <div class="panel panel-info ui-tabs-panel">
            <div class="panel-heading">Tabla de Colocaciones </div>
            <div class="panel-body color-orange">

                <table data-toggle="table" data-url="tables/data2.json">
                    <thead>
                    <tr>
                        <th>nro</th>
                        <th>Equipos</th>
                        <th>PJ</th>
                        <th>PG</th>
                        <th>PE</th>
                        <th>PP</th>
                        <th>GF</th>
                        <th>GE</th>
                        <th>DG</th>
                        <th>Puntos</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $nro=1;?>
                    @foreach($tabla as $value)
                        <tr>
                            <td>{{$nro++}}</td>
                            <td>{{Equipo::find($value->equipo)->nombre}}</td>
                            <td>{{$value->PJ}}</td>
                            <td>{{$value->PG}}</td>
                            <td>{{$value->PE}}</td>
                            <td>{{$value->PP}}</td>
                            <td> {{$value->GF}}</td>
                            <td>{{$value->GE}}</td>
                            <td>{{$value->DG}}</td>
                            <td>{{$value->puntaje}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    </div>
        <div class="row">
            <div class=" col-md-11" id="posiciones">
                <div class="datepicker glyphicon-calendar" >
                    nada
                </div>

            </div>

        </div>






    </div>



@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>

@stop

@endsection





