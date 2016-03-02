<div class="col-md-12 col-no-gutter">
    <div class="panel panel-default">
        <div class="panel-heading">envio plantillas a equipos</div>
        <div class="panel-body">
            <div class="canvas-wrapper">
                <div class="col-md-12">
                    {{ Form::open(array('url'=>'fechas/detail/partido/plantillas/add.html','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}
                    <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                    {{ Form::hidden('idtorneo',$torneo->codRueda) }}
                    {{ Form::hidden('codcampeonato',$codcampeonato) }}
                    {{ Form::hidden('idfecha',$idfecha )}}
                    {{ Form::hidden('codpartido',$partido->codPartido) }}
                    {{ Form::hidden('codequipo1',$equipo1->codEquipo) }}
                    {{ Form::hidden('codequipo2',$equipo2->codEquipo) }}

                    <button type="submit" class="btn btn-primary center-block">Enviar plantillas
                    </button>
                    {{ Form::close()}}
                    <!-- END CONTENIDO DEL FORMULARIO -->
                </div>
            </div>
        </div>
    </div>
</div>
