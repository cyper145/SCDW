@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('estilos')
    <link href="{{asset('/js/jquery-ui/jquery-ui.css')}}" rel="stylesheet">
@stop

@section('rutanavegacion')
@stop

@section('nombrevista')
    @lang('Comision de Justica')
@stop

@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">moficar los datos</div>
                <div class="panel-body">

                    <div class="col-md-7 col-sm-8">
                        {{ Form::open(array('url'=>'miembrocomjusticia/formulario2/'.$consultatabla->id,'autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}

                        <!-- BEGIN PARA MANEJO DE ERRORES -->
                        @if (count($errors) > 0)
                            <div class="alert bg-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <ul class="error_list">
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                                    <!-- END PARA MANEJO DE ERRORES -->

                            <!-- BEGIN CONTENIDO DEL FORMULARIO -->

                            <div class="form-group">
                                {{Form::label('lbldocente','Docente:')}}
                                {{Form::text('docente',$consultatabla->dataDocente[0]->coddocente.' '.$consultatabla->dataDocente[0]->nombre.' '.$consultatabla->dataDocente[0]->apellidopaterno.' '.$consultatabla->dataDocente[0]->apellidomaterno,['class'=>'form-control','placeholder'=>'ingrese docente','id'=>'docenteauto'])}}
                            </div>
                            <div class="form-group">
                                <label>Rol</label>
                                <br>
                                {{Form::select('rol',['Presitente'=>'Presitente','Secretario'=>'Secretario'],null,['class'=>'form-control-static label-success'])}}
                            </div>
                            <div class="form-group">
                                <label>Campeonato</label>
                                <select  class="form-control" name="campeonato">
                                    @foreach( $camptodo as $val)
                                        <option class="form-control" value="{{$val->codcampeonato}}">{{$val->codcampeonato}} {{$val->nombre}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="reset" class="btn btn-default">Cancelar</button>
                            <!-- END CONTENIDO DEL FORMULARIO -->


                    </div>
                </div>
                {{ Form::close()}}
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
@stop

@endsection