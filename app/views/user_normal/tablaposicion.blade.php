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
    <div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
                        Campeonato: {{$campeonatoactual->nombre}} /
                        Año: {{$campeonatoactual->anioacademico}}
                    </div>
					<div class="panel-body">
						<div class="canvas-wrapper">
                            (puntaje)
							<canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>
						</div>
					</div>
                    <div class="panel-footer">
                        Leyenda:
                    </div>
				</div>
			</div>
		</div><!--/.row-->



	</div>	<!--/.main-->
    <div class="col-md-12" id="posiciones">
        <div class="panel panel-danger">
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
                            <td>{{$value->equipo}}</td>
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
            <div class="panel-footer">
                <a class="btn btn-danger" href="#">Aceptar</a>
            </div>
        </div>
    </div>



@section ('scrips')
    <script src="{{asset('/js/bootstrap-table.js')}}"></script>
    <script type="text/javascript">
        // nombre de equipos            // valor de
        var a = "<?php echo $d; ?>";    var a = "<?php echo $d; ?>";
        var b = "<?php echo $d; ?>";    var a = "<?php echo $d; ?>";
        var c = "<?php echo $d; ?>";    var a = "<?php echo $d; ?>";
        var d = "<?php echo $d; ?>";    var a = "<?php echo $d; ?>";
        var e = "<?php echo $d; ?>";    var a = "<?php echo $d; ?>";
        var f = "<?php echo $d; ?>";    var a = "<?php echo $d; ?>";
        var g = "<?php echo $d; ?>";    var a = "<?php echo $d; ?>";
        var h = "<?php echo $d; ?>";    var a = "<?php echo $d; ?>";
        var i = "<?php echo $d; ?>";    var a = "<?php echo $d; ?>";

        matriz = new Array();
        matriz[0] = 10;
        matriz[1] = 20;
        matriz[2] = 30;
        matriz[3] = 40;

        var barChartData = {
            labels : ["Info","Civil","Mate","Mate","test","Info","Civil","Mate","test"],
            datasets : [
                {
                    fillColor : "rgba(147, 208, 60, 1)",
                    strokeColor : "rgba(48, 164, 255, 0.8)",
                    highlightFill : "rgba(48, 164, 255, 0.75)",
                    highlightStroke : "rgba(48, 164, 255, 1)",
                    data : matriz
                }
            ]
        }
    </script>
@stop

@endsection





