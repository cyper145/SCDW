@extends('_templates.logintemp')

@section('titulo')
    @lang('Varapp.nombre_sistema_mediano')
@stop

@section('contenido')
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <center><div class="panel-heading">LOG IN</div></center>
                <div class="panel-body">
                    {{Form::open(array('metod'=>'POST','url'=>'/login','role'=>'form'))}}
                    
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
                    
                    @if(Session::has('registro'))
                        <h3>{{Session::get('registro')}}</h3>
                    @endif
                    <fieldset>
                        <div class="form-group">
                            {{Form::text('username',null,array('class'=>'form-control','placeholder'=>'usuario','autofocus'=>'')) }}
                        </div>
                        <div class="form-group">
                            {{Form::password('password',array('class'=>'form-control','placeholder'=>'contraseña','value'=>''))}}
                        </div>
                        <center>
                            {{Form::submit('Acceder', array('class' => 'btn btn-default'))}}
                        </center>
                    </fieldset>
                    {{Form::close()}}
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
@stop



