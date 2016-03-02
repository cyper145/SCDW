@extends('_templates.apptemp')

@section('titulo')
    @lang('crear una nueva comision organizadora')
@stop

@section('estilos')
<link href="{{asset('/js/jquery-ui/jquery-ui.css')}}" rel="stylesheet">
@stop

@section('rutanavegacion')
    <li><a href="{{ URL::to( 'usuariocorgcrear');}}"><span > nuevo administrador</span></a></li>
@stop

@section('nombrevista')
    @lang('NUEVA CUENTA DE COMISION ORGANIZADOR')
@stop

@section('contenido')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Ingrese los datos de la nueva comision organizadora</div>
            <div class="panel-body">
                
                <div class="col-md-12 col-sm-8">
                    {{ Form::open(array('url'=>'usuariocorgcrear','autocomplete'=>'off','class'=>'form_horizontal','role'=>'form'))}}

                        <!-- BEGIN PARA MANEJO DE ERRORES -->
                        @if (count($errors) > 0)
                        <div class="alert bg-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul class="error_list">
                                @foreach ($errors->all() as $error)
                                <li >
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
                            {{Form::label('lblusuario','Usuario:')}}
                            {{Form::text('usuario',null,['class'=>'form-control','placeholder'=>'ingrese el un usuario para la comision organizadora'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('lblpassword','Contraseña:')}}
                            {{Form::password('password',['class'=>'form-control','placeholder'=>'ingrese una contraseña','value'=>''])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('lblpassword2','Confirmar contraseña:')}}
                            {{Form::password('password2',['class'=>'form-control','placeholder'=>'repita la contraseña','value'=>''])}}
                        </div>
                        <!-- determinar segun los integrantes(su departamento academico)  -->
                        <div class="form-group">
                            {{Form::label('lblorganizador','Nombre comision organizadora:')}}
                            {{Form::text('Comision',null,['class'=>'form-control','placeholder'=>'ingrese un nombre para la comision organizadora'])}}
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('lblestado','Estaso:')}}
                            <br>
                            {{Form::select('estado',['activo'=>'activo','desactivo'=>'desactivo','bloqueado'=>'bloqueado'],null,['class'=>'form-control-static label-success'])}}
                        </div>
                        <!-- END CONTENIDO DEL FORMULARIO -->


                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group">
                    {{ Form::submit('Crear Cuenta',['class' => 'btn btn-primary margin btn-lg btn-block'])}}
                </div>                
            </div>
            
            {{ Form::close()}}
        </div>
    </div>
</div>

@endsection