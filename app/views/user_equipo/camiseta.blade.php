@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('rutanavegacion')
    <li>settings</li>
@stop

@section('nombrevista')
    @lang('Settings')
@stop

@section('contenido')
    <!-- BEGIN PARA MANEJO DE ERRORES -->
    @include('alerts.allerrors')
    <!-- END PARA MANEJO DE ERRORES -->
    <div class="col-md-6 col-no-gutter">
        <div class="panel panel-default">
            <div class="panel-heading text-center">Subir una foto del uniforme del equipo</div>
            <div class="panel-body">
                <div class="col-md-12">
                    {{ Form::open(['url'=>'jugador/camiseta.html','files' => true,'autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'])}}
                    <!-- BEGIN CONTENIDO DEL FORMULARIO -->
                    <div class="form-group">
                        <label>Imagen del uniforme:</label><br>
                        <div class="col-sm-10">
                            <input name="uniforme" type="file" id="imgInp" class="btn btn-default">
                        </div>
                    </div>

                    <img id="blah" style="width: 200px" class="img-responsive"/><br><br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    {{ Form::close()}}
                    <br>
                    <button type="submit" class="btn btn-danger" onclick="history.back()">Cancelar</button>
                    <!-- END CONTENIDO DEL FORMULARIO -->
                </div>
            </div>
        </div>
    </div>

@section ('scrips')
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
@stop