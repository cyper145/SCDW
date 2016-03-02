<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- BEGIN PARA PONER TITULO DE LA VENTANA-->
	<title>@section('titulo')@show</title>
        <!-- END PARA PONER TITULO DE LA VENTANA -->
	<link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('/css/datepicker3.css')}}" rel="stylesheet">
	<link href="{{asset('/css/styles.css')}}" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        <!-- BEGIN PARA AUMENTAR ESTILOS -->
        @yield('estilos')
        <!-- END PARA AUMENTAR ESTILOS -->
        
	<!--[if lt IE 9]>
	<link href="css/rgba-fallback.css" rel="stylesheet">
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
    </head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid ">
			<div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand" href="{{ URL::to( '/');}}"><span>Campeonato<img src="{{asset('/bg/logo/balon.png')}}" /> </span>Docentes</a>
                <a class="navbar-brand" href="http://www.unsaac.edu.pe/"><img src="{{asset('/bg/logo/unsaac.png')}}" /></a>
				<ul class="nav navbar-top-links navbar-right">
                    <!-- BEGIN NAV TOP BAR -->
                    @include('_templates.topbar')
                    <!-- BEGIN NAV TOP BAR -->
				</ul>
                                
			</div>
		</div><!-- /.container-fluid -->
	</nav>


	<!-- BEGIN MAIN SIDEBAR -->
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		@include('_templates.sidebar')
	</div>
	<!-- END MAIN SIDEBAR -->


	<!--PARTE DE CONTENIDO-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		<div class="row">
                    <ol class="breadcrumb">
                        @section('rutanavegacion')@show
                    </ol>
		</div><!--/.row-->
                
                <div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">@section('nombrevista')@show</h3>
			</div>
		</div><!--/.row-->
                
		@section('contenido')@show

	</div>
	<!-- FIN DE PARTE DE CONTENIDO-->

    <div class="modal-footer">
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b> Versión</b> 3.3
            </div>
            <strong>Copyright &copy; UNSAAC-2016 Wilson RS y Percy CA . </strong> All rights reserved.
        </footer>
    </div>
        
	<script src="{{asset('/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{asset('/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/js/chart.min.js')}}"></script>
	<script src="{{asset('/js/chart-data.js')}}"></script>
	<script src="{{asset('/js/easypiechart.js')}}"></script>
	<script src="{{asset('/js/easypiechart-data.js')}}"></script>
	<script src="{{asset('/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{asset('/js/custom.js')}}"></script>
	<script>
	window.onload = function(){
		var chart2 = document.getElementById("bar-chart").getContext("2d");
		window.myBar = new Chart(chart2).Bar(barChartData, {
			responsive : true,  
			scaleLineColor: "rgba(255,255,255,.2)", 
			scaleGridLineColor: "rgba(255,255,255,.05)",
			scaleFontColor: "#F9243F"
		});
		var chart5 = document.getElementById("radar-chart").getContext("2d");
		window.myRadarChart = new Chart(chart5).Radar(radarData, {
			responsive : true,
			scaleLineColor: "rgba(255,255,255,.05)",
			angleLineColor : "rgba(255,255,255,.2)"
		});
		
	};
	</script>
        <!-- BEGIN PARA AUMENTAR SCRIPS  -->
        @yield('scrips')
        <!-- END PARA AUMENTAR SCRIPS  -->
</body>

</html>