@extends('_templates.apptemp')

@section('titulo')
    @lang('delegado')
@stop

@section('estilos')
    <link href="{{asset('/js/jquery-ui/jquery-ui.css')}}" rel="stylesheet">
@stop

@section('rutanavegacion')
    <li>{{ HTML::link('delegado/listar.html','Relacion de delegados')}} </li>
    <li>editar jugador</li>
@stop

@section('nombrevista')
    @lang('Jugador')
@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allerrors')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">modifica los datos del jugador</div>
                <div class="panel-body">
                    <div class="col-md-12">
                        {{ Form::open(['url'=>'delegado/edit.html','files' => true,'autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'])}}
                        <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                        {{Form::hidden('idjugador',$jugadoraeditar->dni)}}
                        <div class="form-group">
                            {{Form::label('lbldocente','Nombre:')}}
                            {{Form::text('Nombre',$jugadoraeditar->codDocente.' '.$jugadoraeditar->dataDocente[0]->nombre.' '.$jugadoraeditar->dataDocente[0]->apellidoP.' '.$jugadoraeditar->dataDocente[0]->apellidoM,['class'=>'form-control','placeholder'=>'ingrese el nombre del integrante','id'=>'docenteauto','readonly'=>'readonly'])}}
                        </div>
                        <div class="form-group ">
                            {{Form::label('lblrol','rol:')}}
                            {{Form::select('rol',array('delegado' => 'delegado', 'codelegado' => 'codelegado'),['class'=>'form-control'])}}
                        </div>
                       <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-default">Limpiar</button>
                        {{ Form::close()}}
                        <br>
                        <button type="submit" class="btn btn-danger" onclick="history.back()">Cancelar</button>
                        <!-- END CONTENIDO DEL FORMULARIO -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@section ('scrips')
    <script src="{{asset('/js/jquery-ui/jquery-ui.js')}}"></script>
    <script>
        $(function() {
            $("#docenteauto").autocomplete({
                source: "autodocente",
                minLength: 1,
                select: function( event, ui ) {
                    $('#response').val(ui.item.id);
                }
            });
        });
    </script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){
            readURL(this);
        });
    </script>
@stop

@endsection