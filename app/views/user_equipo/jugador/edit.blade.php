@extends('_templates.apptemp')

@section('titulo')
    @lang('Jugador')
@stop

@section('estilos')
    <link href="{{asset('/js/jquery-ui/jquery-ui.css')}}" rel="stylesheet">
@stop

@section('rutanavegacion')
    <li>{{ HTML::link('jugador/listar.html','Relacion de jugadores')}} </li>
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
                        {{ Form::open(['url'=>'jugador/edit.html','files' => true,'autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'])}}
                        <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                        {{Form::hidden('idjugador',$jugadoraeditar->dni)}}
                        <div class="form-group">
                            {{Form::label('lbldocente','Nombre:')}}
                            {{Form::text('Nombre',$jugadoraeditar->codDocente.' '.$jugadoraeditar->dataDocente[0]->nombre.' '.$jugadoraeditar->dataDocente[0]->apellidoP.' '.$jugadoraeditar->dataDocente[0]->apellidoM,['class'=>'form-control','placeholder'=>'ingrese el nombre del integrante','id'=>'docenteauto','readonly'=>'readonly'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('lbldireccion','direccion:')}}
                            {{Form::text('direccion','',['class'=>'form-control','placeholder'=>'ingrese el direccion'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('lbltelefono','telefono:')}}
                            {{Form::tel('telefono','',['class'=>'form-control','placeholder'=>'ingrese el telefono'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('lbledad','edad:')}}
                            {{Form::number('edad','',['class'=>'form-control','placeholder'=>'ingrese el edad'])}}
                        </div>


                        <div class="form-group">
                            <label>Foto:</label><br>
                            <div class="col-sm-10">
                                <input name="foto" type="file" id="imgInp" class="btn btn-default">
                            </div>
                        </div>
                        <?php
                        if($jugadoraeditar->foto != '')
                        {
                            echo 'Foto actual';
                            echo HTML::image('storage/jugador/'.$jugadoraeditar->foto,'imagen jugador',['class'=>'img-responsive','title'=>$jugadoraeditar->foto,'style'=>'width: 70px']);
                        }
                        else
                        {
                            echo '<span class="label label-info">sin foto</span>';
                        }
                        ?>




                        <img id="blah" title="Nueva foto a insertar" style="width: 200px" class="img-responsive"/><br><br>
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