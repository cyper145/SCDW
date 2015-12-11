<div class="form_contenido">
    <div id="step-1">
        <div class="row">
            {{ Form::hidden('idjugadorenjuego',null,array("id"=>"idjugadorenjuego","class"=>"form-control","maxlength"=>"4","data-rule-maxlength"=>"4")) }}
                
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('condicionenpartido', 'Condiciones en partido',array("class"=>"control-label")) }}
                    {{ Form::text('condicionenpartido',null,array("id"=>"condicionenpartido","class"=>"required form-control","maxlength"=>"30","data-rule-maxlength"=>"30","data-rule-minlength"=>"5")) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('nrocamiseta', 'Nro. de camiseta',array("class"=>"control-label")) }}
                    {{ Form::text('nrocamiseta',null,array("id"=>"nrocamiseta","class"=>"required form-control","maxlength"=>"2","data-rule-maxlength"=>"2","data-rule-minlength"=>"1")) }}
                </div>
            </div>
			<div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('escapitan', 'Estado del jugador',array("class"=>"control-label")) }}
                    <div>{{ Form::label('escapitan', 'Es capitan ',array("class"=>"checkbox-inline")) }}
                    {{ Form::checkbox('escapitan',1,null, array('id'=>'escapitan')) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">

                	{{ Form::label('dni', 'DNI del Jugador ',array("class"=>"control-label")) }}
                    <a class="popoverHelp btn btn-xs btn-success" href="javascript:void(0)" data-content="Buscar por Código equipo y Nombre de equipo" rel="popover" data-placement="top" data-original-title="Búsqueda" data-trigger="hover"><i class="glyphicon glyphicon-info-sign"></i></a>
                    {{ Form::text('dni',null,array("id"=>"dni","class"=>"form-control required","maxlength"=>"8","data-rule-maxlength"=>"8")) }}
					<?php if(isset($jugador_juego)&&count($jugador_juego->dataEquipo)>0) {echo ($jugador_juego->dataEquipo[0]->nombre);}?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('codpartido', '',array("class"=>"control-label")) }}
                    <a class="popoverHelp btn btn-xs btn-success" href="javascript:void(0)" data-content="Asignar nro de planilla" rel="popover" data-placement="top" data-original-title="Búsqueda" data-trigger="hover"><i class="glyphicon glyphicon-info-sign"></i></a>
                    {{ Form::text('codpartido',null,array("id"=>"codpartido","class"=>"form-control required","maxlength"=>"8","data-rule-maxlength"=>"8")) }}
                </div>
            </div>
        </div>
    </div>
    
</div>
