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
    Actualizando Jugador
@stop
<!-- inicio: CONTENIDO -->
@section('contenido')
	<div class="row">
        <div class="col-sm-12">
        	@include('alerts.request')
			{{Form::model($jugador,['route'=> ['jugador.update',$jugador->dni],'method'=>'PUT','files' => true])}}
			<div class="panel panel-default">
				<div class="panel-heading">Editar Jugador</div>
				<div class="panel-body">
            		@include('user_com_organizing.jugador.forms.jugador')
            	</div>
            </div>
			<hr>
			<div class="row">
				<div class="col-md-3">
					{{ link_to_route('jugador.index', $title = 'Cancelar', $parameters = array(), array('class'=>'btn btn-danger')) }}
					{{ Form::submit('Actualizar',array('class'=>'btn btn-primary')) }}
				</div>
			</div>
			{{ Form::token() }}
            {{ Form::close()}}
        </div>
    </div>
    <!-- SCRIPT -->
@endsection
<!-- fin: CONTENIDO -->
@section('scripts')
    <script type="text/javascript">
    $(document).ready(function() {
        //inicio
        $("#codequipo").on('keyup', function(e) {
            if ($(this).val().length > 2) {
                var codNombreEquipo = $(this).val().trim();
                if ($(this).val() != '') {
                    //--
                    var value = $(this).val();
                    var token = $("#token").val();
                    $("#loading_search_eq").html('<span class="glyphicon glyphicon-refresh glyphicon-spin" style="color:#333;"></span>');
                    var route = "/tool/equipo/"+codNombreEquipo;
                    $.get(route, function(res){
                        html = '<div style="position: absolute;width: 100%;padding-right: 8px;">';
                        html += '<div style="position: absolute;top:0px;right:0px;z-index:100;">';
                        html += '<a class="bsq_cerrar" href="javascript:void(0);" style="position:absolute;margin-right:-11px;right: 0px;top: 2px;background: #F1E5E5;padding: 2px;">';
                        html += '<i class="glyphicon glyphicon-remove" style="font-size: 18px;color: #E25D5D;"></i></a></div>';
                        if(res.length>0){
                            for (i = 0; i < res.length; i++) {
                                    html += '<div class="item_busqeda" style=" width: 100%;background: #E6E7E7;">';
                                    html += '<a class="busitem list-group-item" style="padding-top:3px;padding-bottom:3px;" href="javascript:void(0);" id="its_' + res[i].codequipo + '" rel="'+res[i].nombre+'">';
                                    html += '<div class="list-group-item-heading"><b>Codigo:</b>' + res[i].codequipo + "<br>";
                                    html += '<b>Nombre de equipo:</b> '+ res[i].nombre + '</div>';
                                    html += '</a></div>';
                            }
                        }else{
                            html += '<div class="item_busqeda" style=" width: 100%;background: #E6E7E7;">';
                            html += '<a href="javascript:void(0);" id="its_" class="busitem list-group-item">';
                            html += '<div class="list-group-item-heading">' + "sin resultados" + '</div>';
                            html += '</a></div>';
                        }
                        $("#lista_eq").html(html);$("#loading_search_eq").html('');
                        return false;
                    });
                    //---
                }else{
                    $("#codequipo").focus();$("#lista_eq").html('');
                }
            }
        });
        // fin
        //inicio doc
        $("#coddocente").on('keyup', function(e) {
            if ($(this).val().length > 2) {
                var codNombreDocentes = $(this).val().trim();
                if ($(this).val() != '') {
                    //--
                    var value = $(this).val();
                    var token = $("#token").val();
                    $("#loading_search_doc").html('<span class="glyphicon glyphicon-refresh glyphicon-spin" style="color:#333;"></span>');
                    var route = "/tool/docente/"+codNombreDocentes;
                    $.get(route, function(res){
                        html = '<div style="position: absolute;width: 100%;padding-right: 8px;">';
                        html += '<div style="position: absolute;top:0px;right:0px;z-index:100;">';
                        html += '<a class="bsq_cerrar" href="javascript:void(0);" style="position:absolute;margin-right:-11px;right: 0px;top: 2px;background: #F1E5E5;padding: 2px;">';
                        html += '<i class="glyphicon glyphicon-remove" style="font-size: 18px;color: #E25D5D;"></i></a></div>';
                        if(res.length>0){
                            for (i = 0; i < res.length; i++) {
                                    html += '<div class="item_busqeda" style=" width: 100%;background: #E6E7E7;">';
                                    html += '<a class="busitem list-group-item" style="padding-top:3px;padding-bottom:3px;" href="javascript:void(0);" id="its_' + res[i].coddocente + '" rel="'+res[i].nombrecompleto+'">';
                                    html += '<div class="list-group-item-heading"><b>Codigo:</b>' + res[i].coddocente + "<br>";
                                    html += '<b>Nombre de docente:</b> '+ res[i].nombrecompleto + '</div>';
                                    html += '</a></div>';
                            }
                        }else{
                            html += '<div class="item_busqeda" style=" width: 100%;background: #E6E7E7;">';
                            html += '<a href="javascript:void(0);" id="its_" class="busitem list-group-item">';
                            html += '<div class="list-group-item-heading">' + "sin resultados" + '</div>';
                            html += '</a></div>';
                        }
                        $("#lista_doc").html(html);$("#loading_search_doc").html('');
                        return false;
                    });
                    //---
                }else{
                    $("#coddocente").focus();$("#lista_doc").html('');
                }
            }
        });
        // fin
        //inicio
        $('body').on('click', 'a.busitem', function() {
            var nombre = $(this).attr("rel");
            var tipo = $(this).parent().parent().parent().attr("id");
            tipo=tipo.substring(6,tipo.lenght);
            var coditem = ($(this).attr("id")).substring(4, $(this).attr("id").lenght);
            switch(tipo) {
                case "eq":
                        if (nombre != '') {
                            $("#codequipo").val(coditem);$("#nombreEqui").html(nombre.substring(0,18).toLowerCase());$("#lista_eq").html('');
                        } else {
                            $("#lista_eq").html('');
                        }
                    break;
                case "doc":
                        if (nombre != '') {
                            $("#coddocente").val(coditem);$("#nombreDoc").html(nombre.substring(0,18).toLowerCase());$("#lista_doc").html('');
                        } else {
                            $("#lista_doc").html('');
                        }
                    break;
            }
        });
        //fin
        //inicio
        $('body').on('click', 'a.bsq_cerrar', function() {
            var tipo = $(this).parent().parent().parent().attr("id");
            tipo=tipo.substring(6,tipo.lenght);
            switch(tipo) {
                case "eq":
                        $("#codequipo").val('');$("#nombreEqui").html('');$("#lista_eq").html('');$("#codequipo").focus();
                    break;
                case "doc":
                        $("#coddocente").val('');$("#nombreDoc").html('');$("#lista_doc").html('');$("#coddocente").focus();
                    break;
            }
        });
        //fin
    });
    </script>
@endsection