@extends('_templates.apptemp')

@section('titulo')
    @lang('Varapp.partido')
@stop

@section('rutanavegacion')        
        <li><a href="{{ URL::to( '/partido/editar');}}"><span class="glyphicon glyphicon-th-list"></span></a></li>
	   
@stop
@section('contenido')
        <!-- Main row -->
        <div class="row">
            <!-- INICIO: BOX PANEL -->
            <div class="col-md-12 col-sm-8">
                @foreach($todopartidos as $part)
                    {{ Form::open(array('url' => 'partido/editar'.$part->codpartido,'method' => 'put', 'files' => true, 'class' => 'form-horizontal')) }}
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Editar partido</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                {{ Form::label('Cod_partido', Lang::get('Código Partido'),array('class'=>'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    <input id="Cod_partido" type="text" placeholder="Código del Partido"  value="{{$part->codpartido}}" class="form-control" name="Cod_partido" onKeyPress="return validar(event)" maxlength="7" required>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('nombres', Lang::get('DNI'),array('class'=>'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    <input id="dni" type="text" placeholder="DNI" value="{{$alu->dni}}" class="form-control" name="dni" onKeyPress="return validar(event)" maxlength="9" required>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('nombres', Lang::get('Nombres'),array('class'=>'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    <input id="nombres" type="text" placeholder="Nombres" value="{{$alu->nombres}}" class="form-control" name="nombres"  maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('apellidos', Lang::get('Apellidos'),array('class'=>'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    <input id="apellidos" type="text" placeholder="Apellidos" value="{{$alu->apellidos}}" class="form-control" name="apellidos"  maxlength="60" required>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('direccion', Lang::get('Dirección'),array('class'=>'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    <input id="direccion" type="text" placeholder="Dirección" value="{{$alu->direccion}}" class="form-control" name="direccion"  maxlength="60" required>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('telefono', Lang::get('Teléfono'),array('class'=>'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    <input id="telefono" type="text" placeholder="Teléfono"  value="{{$alu->telefono}}" class="form-control" name="telefono" onKeyPress="return validar(event)" maxlength="9" minlength="6" required>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('correo', Lang::get('Correo'),array('class'=>'col-sm-2 control-label')) }}
                                <div class="col-sm-10">
                                    <input id="correo" type="email" placeholder="Correo" value="{{$alu->correo}}" class="form-control" name="correo"  required>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('fecha', Lang::get('Fecha de Ingreso'),array('class'=>'col-sm-2 control-label')) }}
                                <div class="col-sm-3">
                                    <div class="input-group input-group-sm">
                                        {{ Form::text('fecha',$alu->fecha_ingreso,array('class'=>'form-control fecha_cal','id'=>'fecha_fin','placeholder'=>Lang::get('sistema.formato_fecha'),'readonly'=>'readonly')) }}
                                        <span class="input-group-btn">
                                  <button class="btn bg-purple btn-flat btn_calen" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            {{ Form::submit(Lang::get('Editar Partido'), array('class' => 'btn btn-info pull-right')) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                @endforeach
            </div>
            <!-- INICIO: BOX PANEL -->
        </div><!-- /.box -->



@stop

