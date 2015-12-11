<div class="form_contenido">
    <div id="step-1">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('dni', 'DNI',array("class"=>"control-label")) }}
                    {{ Form::text('dni',null,array("id"=>"dni","placeholder"=>"Ingrese el dni","class"=>"required form-control","maxlength"=>"8","data-rule-maxlength"=>"8","data-rule-minlength"=>"8")) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('foto', 'Foto',array("class"=>"control-label")) }} <?php echo isset($jugador->foto)?'<span class="label label-primary">'.$jugador->foto.'</span>':'<span class="label label-info">sin foto</span>'?>
                    {{ Form::file('foto',array("id"=>"foto","class"=>"required form-control","maxlength"=>"70"))}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('telefono', 'Telefono',array("class"=>"control-label")) }}
                    {{ Form::text('telefono',null,array("id"=>"telefono","class"=>"required form-control","maxlength"=>"9","data-rule-maxlength"=>"9","data-rule-minlength"=>"6")) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('habilitado', 'Estado',array("class"=>"control-label")) }}
                    <div>
                        <label class="radio-inline">
                            {{ Form::radio('habilitado', '1', null,array("id"=>"habilitado_1","class"=>"green required")) }}
                            Habilitado
                        </label>
                        <label class="radio-inline">
                            {{ Form::radio('habilitado', '0', null,array("id"=>"habilitado_0","class"=>"red required")) }}
                            Deshabilitado
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::hidden('codequipo',Session::get('user_codequipo'),array("id"=>"codequipo","class"=>"form-control required","autocomplete"=>"off","style"=>"background:#fff;color:#333;","maxlength"=>"10","data-rule-maxlength"=>"10")) }}
					<?php if(isset($jugador)&&count($jugador->dataEquipo)>0) {echo ($jugador->dataEquipo[0]->nombre);}?>
					<div id="loading_search_eq" class="loading_search"></div>
                    <div id="lista_eq" rel="eq" class="busqueda_contenedor col-md-4 col-sm-offset-4"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('coddocente', 'Código de Docente',array("class"=>"control-label")) }}
                    <a class="popoverHelp btn btn-xs btn-success" href="javascript:void(0)" data-content="Buscar por Código de docente y Nombre de docente" rel="popover" data-placement="top" data-original-title="Búsqueda" data-trigger="hover"><i class="glyphicon glyphicon-info-sign"></i></a>
                    &nbsp;<div id="nombreDoc" style="width: 140px;display: inline;"></div>
                    {{ Form::text('coddocente',null,array("id"=>"coddocente","class"=>"form-control required","autocomplete"=>"off","style"=>"background:#fff;color:#333;","maxlength"=>"10","data-rule-maxlength"=>"10")) }}
					<?php if(isset($jugador)&&count($jugador->dataDocente)>0) {echo $jugador->dataDocente[0]->apellidopaterno.' '.$jugador->dataDocente[0]->apellidomaterno.', '.$jugador->dataDocente[0]->nombre;} ?>
                    <div id="loading_search_doc" class="loading_search"></div>
                    <div id="lista_doc" class="busqueda_contenedor col-md-4 col-sm-offset-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>